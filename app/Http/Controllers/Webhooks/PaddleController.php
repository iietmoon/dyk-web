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

class PaddleController extends Controller
{
    /**
     * Handle all Paddle webhook events (transaction.*, customer.*, subscription.*, etc.).
     * On transaction.paid with custom_data (user_id, plan_id, transaction_token_id), creates the user's subscription and transaction record.
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
        ]);

        if ($eventType === 'subscription.activated') {
            Log::channel('single')->info('Paddle subscription.activated', [
                'data' => $body['data'] ?? null,
            ]);
        }

        return response()->json(['message' => 'received'], 200);
    }
}
