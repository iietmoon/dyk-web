<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaddleController extends Controller
{
    /**
     * Handle all Paddle webhook events (transaction.*, customer.*, subscription.*, etc.).
     */
    public function handle(Request $request)
    {
        $body = $request->all();
        $eventType = $body['event_type'] ?? 'unknown';

        if ($eventType === 'subscription.activated') {
            $this->handleSubscriptionActivated($body);
        }

        return response()->json(['message' => 'received'], 200);
    }

    /**
     * Fetch subscription details from Paddle API and log. Uses PADDLE_API_KEY (Bearer).
     */
    protected function handleSubscriptionActivated(array $body): void
    {
        $subscriptionId = $body['data']['id'] ?? null;
        if (! $subscriptionId) {
            return;
        }

        $apiKey = trim((string) config('services.paddle.api_key', ''));
        if ($apiKey === '') {
            Log::channel('single')->warning('Paddle subscription.activated: PADDLE_API_KEY not set');
            return;
        }

        $env = strtolower((string) config('services.paddle.environment', 'sandbox'));
        $baseUrl = $env === 'production' ? 'https://api.paddle.com' : 'https://sandbox-api.paddle.com';
        $url = "{$baseUrl}/subscriptions/{$subscriptionId}";

        $response = Http::withToken($apiKey)
            ->acceptJson()
            ->get($url);

        if ($response->successful()) {
            Log::channel('single')->info('Paddle subscription.activated', [
                'data' => $response->json(),
            ]);
        } else {
            Log::channel('single')->error('Paddle subscription.activated API call failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'subscription_id' => $subscriptionId,
            ]);
        }
    }
}
