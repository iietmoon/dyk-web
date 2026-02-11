<?php

namespace App\Http\Controllers\Payments;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\TransactionToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
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
     * Create a payment link for the authenticated user and the given plan.
     * Protected route – requires auth (same style as /me, update-profile).
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
        $token = generate_signed_token(64, 60);

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
