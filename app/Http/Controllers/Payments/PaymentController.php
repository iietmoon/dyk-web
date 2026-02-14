<?php

namespace App\Http\Controllers\Payments;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\TransactionToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Paddle\SDK\Client;
use Paddle\SDK\Environment;
use Paddle\SDK\Options;
use Paddle\SDK\Resources\Subscriptions\Operations\ListSubscriptions;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Subscription;
use App\Services\EmailService;

class PaymentController extends Controller
{
    public function __construct(
        private EmailService $emailService
    ) {}

    /**
     * Get all active subscription plans.
     *
     * @group Payments
     */
    public function getPlans()
    {
        $plans = Plan::where('is_active', true)->get();
        return HttpStatusCode::OK->toResponse([
            'data' => $plans,
        ]);
    }
    /**
     * Show the payment page (view) for a token-based link. Resolves token and displays plan + user.
     * Public route – no auth. URL: /payment?token=...
     */
    public function showPaymentPage(Request $request)
    {
        $token = $request->query('token');

        if (! $token) {
            return view('website.pay', [
                'error' => 'Missing payment link. Please use the link from your email or app.',
            ]);
        }

        $transactionToken = TransactionToken::with(['user', 'plan'])
            ->where('token', $token)
            ->first();

        if (! $transactionToken) {
            return view('website.pay', [
                'error' => 'Invalid payment link. Please request a new one.',
            ]);
        }

        if (! $transactionToken->isValid()) {
            return view('website.pay', [
                'error' => 'This payment link has expired or already been used. Please request a new one.',
            ]);
        }

        return view('website.pay', [
            'transactionToken' => $transactionToken,
            'plan' => $transactionToken->plan,
            'user' => $transactionToken->user,
            'expires_at' => $transactionToken->expires_at,
        ]);
    }

    /**
     * Show the payment success page.
     *
     * @group Payments
     */
    public function showPaymentSuccessPage(Request $request)
    {
        $transactionId = $request->query('transaction_id');

        if (! $transactionId) {
            return view('website.payment-success', [
                'error' => 'Invalid payment link. Please request a new one.',
            ]);
        }

        $paddle = new Client(
            apiKey: config('services.paddle.api_key'),
            options: new Options(config('services.paddle.environment') === 'sandbox' ?  Environment::SANDBOX : Environment::PRODUCTION),
        );

        try {
            $transaction = $paddle->transactions->get($transactionId);
            // Status is a PaddleEnum: getValue() = string (e.g. 'completed', 'paid'), getKey() = constant name (e.g. 'Completed')
            $statusValue = $transaction->status->getValue();
            if ($statusValue === 'completed' || $statusValue === 'paid') {
                $subscriptions = [];
                $subscription = null;
                // CustomData has a ->data array: ['plan_id' => '...', 'user_id' => '...', 'transaction_token_id' => '...']
                $customData = $transaction->customData?->data ?? [];
                $plan = isset($customData['plan_id']) ? Plan::find($customData['plan_id']) : null;

                if ($transaction->customerId !== null && $plan) {
                    $customerIds = [$transaction->customerId];
                    $priceIds = $plan->provider_product_id ? [$plan->provider_product_id] : [];
                    $subscriptionIds = $transaction->subscriptionId !== null ? [$transaction->subscriptionId] : [];
                    $transactionTokenId = $customData['transaction_token_id'] ?? null;

                    // Paddle can take 15-30s to create the subscription after payment. Retry with short delays.
                    $maxAttempts = 6;
                    $sleepSeconds = 5;
                    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                        $collection = $paddle->subscriptions->list(new ListSubscriptions(
                            customerIds: $customerIds,
                            priceIds: $priceIds,
                            ids: $subscriptionIds,
                        ));
                        $all = iterator_to_array($collection);
                        $subscriptions = $transactionTokenId
                            ? array_values(array_filter($all, function ($sub) use ($transactionTokenId) {
                                $subData = $sub->customData?->data ?? [];
                                return ($subData['transaction_token_id'] ?? null) === $transactionTokenId;
                            }))
                            : $all;
                        $subscription = $subscriptions[0] ?? null;

                        if ($subscription) {
                            break;
                        }
                        if ($attempt < $maxAttempts) {
                            sleep($sleepSeconds);
                        }
                    }

                    if ($subscription) {
                        $user = User::find($customData['user_id']);
                        if ($user) {
                            $billingCycle = $plan->billing_cycle ?? 'monthly';
                            $nextBillingAt = $billingCycle === 'annual'
                                ? now()->addYear()
                                : now()->addMonth();
                            $endsAt = $nextBillingAt;

                            // Amount from Paddle: details.totals is in smallest currency unit (e.g. cents)
                            $totals = $transaction->details->totals;
                            $amountMajor = (float) ($totals->grandTotal ?? $totals->total) / 100;
                            $currency = $transaction->currencyCode->getValue();

                            $createdSubscription = Subscription::create([
                                'user_id' => $user->id,
                                'plan_id' => $plan->id,
                                'status' => 'active',
                                'provider' => 'paddle',
                                'provider_subscription_id' => $subscription->id,
                                'provider_customer_id' => $transaction->customerId,
                                'starts_at' => now(),
                                'ends_at' => $endsAt,
                                'billing_cycle' => $billingCycle,
                                'amount_paid' => $amountMajor,
                                'currency' => $currency,
                                'auto_renew' => true,
                                'next_billing_at' => $nextBillingAt,
                            ]);

                            $firstPayment = $transaction->payments[0] ?? null;
                            $paymentMethodDetails = $firstPayment
                                ? $firstPayment->methodDetails->type->getValue()
                                : 'credit_card';
                            $paidAt = $firstPayment && $firstPayment->capturedAt
                                ? $firstPayment->capturedAt
                                : $transaction->billedAt ?? now();

                            $customer = $transaction->customer;
                            $address = $transaction->address;
                            $billingName = $customer?->name ?? null;
                            $billingEmail = $customer?->email ?? null;
                            $billingAddress = $address
                                ? trim(implode(', ', array_filter([$address->firstLine ?? '', $address->secondLine ?? ''])))
                                : null;
                            $billingCity = $address?->city;
                            $billingState = $address?->region;
                            $billingCountry = $address?->countryCode?->getValue();
                            $billingZip = $address?->postalCode;

                            Transaction::create([
                                'user_id' => $user->id,
                                'subscription_id' => $createdSubscription->id,
                                'transaction_id' => $transaction->id,
                                'provider' => 'paddle',
                                'type' => 'payment',
                                'amount' => $amountMajor,
                                'currency' => $currency,
                                'status' => 'completed',
                                'paid_at' => $paidAt,
                                'payment_method' => 'paddle',
                                'payment_method_details' => $paymentMethodDetails,
                                'billing_name' => $billingName,
                                'billing_email' => $billingEmail,
                                'billing_address' => $billingAddress,
                                'billing_city' => $billingCity,
                                'billing_state' => $billingState,
                                'billing_country' => $billingCountry,
                                'billing_zip' => $billingZip,
                                'description' => 'Payment for ' . $plan->name,
                                'meta' => [
                                    'transaction_id' => $transaction->id,
                                    'subscription_id' => $createdSubscription->id,
                                    'plan_id' => $plan->id,
                                    'user_id' => $user->id,
                                ],
                            ]);

                            $this->emailService->sendWelcomeEmail($user);

                            return view('website.payment-success', [
                                'transaction' => $transaction,
                                'subscriptions' => $subscriptions,
                                'subscription' => $subscription,
                                'plan' => $plan,
                                'custom_data' => $customData,
                            ]);
                        }
                    }

                    // Subscription still not ready after retries: show processing overlay and redirect back after 20s (once)
                    $attempt = (int) $request->query('attempt', 1);
                    if (! $subscription && $attempt < 2) {
                        $retryUrl = route('website.payment.success', [
                            'transaction_id' => $transactionId,
                            'attempt' => $attempt + 1,
                        ]);

                        return view('website.payment-processing', [
                            'success_url' => $retryUrl,
                        ]);
                    }
                    if (! $subscription) {
                        return view('website.payment-error');
                    }
                }
                return view('website.payment-error');
            }
            return view('website.payment-error');
        } catch (\Exception $e) {
            report($e);

            return view('website.payment-error');
        }
    }

    public function showPaymentErrorPage(Request $request)
    {
        return view('website.payment-error');
    }

    /**
     * Create a one-time payment link for the authenticated user and the given plan. Link expires in 60 minutes.
     *
     * @group Payments
     * @bodyParam plan_id string required UUID of an active plan. Example: 019c4e61-596c-70b3-b328-61b379b7854d
     */
    public function createPaymentLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => ['required', 'string', 'uuid'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $plan = Plan::where('is_active', true)->find($request->input('plan_id'));

        if (! $plan) {
            return HttpStatusCode::NotFound->toResponse([
                'errors' => ['plan_id' => ['Plan not found or inactive.']],
            ]);
        }

        $user = $request->user();
        $token = Str::random(64);

        TransactionToken::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'token' => $token,
            'expires_at' => now()->addMinutes(60),
        ]);

        return HttpStatusCode::Created->toResponse([
            'message' => 'Payment link created.',
            'data' => [
                'token' => $token,
                'payment_link' => route('website.payment', ['token' => $token]),
                'plan' => $plan,
                'expires_in_minutes' => 60,
            ],
        ]);
    }
}
