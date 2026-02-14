<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaddleController extends Controller
{
    /**
     * Handle Paddle "subscription.created" webhook (e.g. after checkout).
     * Logs the full payload for testing. Return 200 so Paddle marks the delivery as successful.
     */
    public function subscriptionCreated(Request $request)
    {
        Log::channel('single')->info('Paddle webhook: subscription.created', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'raw' => $request->getContent(),
        ]);

        return response()->json(['message' => 'received'], 200);
    }
}
