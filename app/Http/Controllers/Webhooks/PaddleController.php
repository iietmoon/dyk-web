<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaddleController extends Controller
{
    /**
     * Handle all Paddle webhook events (transaction.*, customer.*, subscription.*, etc.).
     * Paddle sends event_type in the body. Log by event_type for debugging; return 200 so Paddle marks delivery as successful.
     */
    public function handle(Request $request)
    {
        $body = $request->all();
        $eventType = $body['event_type'] ?? 'unknown';

        Log::channel('single')->info("Paddle webhook: {$eventType}", [
            'event_id' => $body['event_id'] ?? null,
            'event_type' => $eventType,
            'occurred_at' => $body['occurred_at'] ?? null,
            'data' => $body['data'] ?? null,
            'body' => $body,
        ]);

        return response()->json(['message' => 'received'], 200);
    }
}
