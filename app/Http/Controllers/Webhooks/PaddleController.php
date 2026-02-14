<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\TransactionToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Paddle\SDK\Client;
use Paddle\SDK\Environment;
use Paddle\SDK\Options;


class PaddleController extends Controller
{
    protected ?Client $paddle = null;

    /**
     * Paddle API client uses the server API key (PADDLE_API_KEY), not the client token.
     * Only available when PADDLE_API_KEY is set in .env.
     */
    protected function paddle(): ?Client
    {
        if ($this->paddle !== null) {
            return $this->paddle;
        }
        $apiKey = config('services.paddle.api_key');
        if (empty($apiKey)) {
            return null;
        }
        $env = strtolower((string) config('services.paddle.environment', 'sandbox'));
        $environment = $env === 'production' ? Environment::PRODUCTION : Environment::SANDBOX;
        $this->paddle = new Client(
            apiKey: $apiKey,
            options: new Options($environment),
        );

        return $this->paddle;
    }

    /**
     * Handle all Paddle webhook events (transaction.*, customer.*, subscription.*, etc.).
     * On transaction.paid with custom_data (user_id, plan_id, transaction_token_id), creates the user's subscription and transaction record.
     */
    public function handle(Request $request)
    {
        $body = $request->all();
        $eventType = $body['event_type'] ?? 'unknown';

        if ($eventType === 'subscription.activated') {
            $client = $this->paddle();
            if ($client) {
                try {
                    $subscription = $client->subscriptions->get($body['data']['id']);
                    Log::channel('single')->info('Paddle subscription.activated', [
                        'data' => $subscription,
                    ]);
                } catch (\Throwable $e) {
                    Log::channel('single')->error('Paddle subscription.activated API call failed', [
                        'error' => $e->getMessage(),
                        'subscription_id' => $body['data']['id'] ?? null,
                    ]);
                }
            } else {
                Log::channel('single')->warning('Paddle subscription.activated: PADDLE_API_KEY not set, cannot fetch subscription');
            }
        }

        return response()->json(['message' => 'received'], 200);
    }
}
