<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExpoNotificationService
{
    public const EXPO_PUSH_URL = 'https://exp.host/--/api/v2/push/send';

    /**
     * Send a push notification to a user. Creates a notification record, then sends to all of the user's Expo push tokens.
     *
     * @param  array<string, mixed>  $data  Optional payload for the app (e.g. {"article_id": "...", "screen": "Article"})
     * @return array{notification: Notification, tickets: array<int, array{status: string, id?: string, message?: string}>}
     */
    public function sendToUser(User $user, string $title, string $body = '', array $data = [], ?string $type = null): array
    {
        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'body' => $body,
            'data' => $data ?: null,
            'type' => $type,
        ]);

        $tokens = $user->expoPushTokens()->pluck('token')->unique()->values()->all();

        if (empty($tokens)) {
            return ['notification' => $notification, 'tickets' => []];
        }

        $tickets = $this->sendPushMessages($tokens, $title, $body, $data);

        if (! empty($tickets)) {
            $firstOk = collect($tickets)->first(fn ($t) => ($t['status'] ?? '') === 'ok');
            $notification->update([
                'sent_at' => now(),
                'expo_ticket_id' => $firstOk['id'] ?? null,
            ]);
        }

        return ['notification' => $notification->fresh(), 'tickets' => $tickets];
    }

    /**
     * Send push messages to Expo push tokens. Batches up to 100 per request.
     *
     * @param  array<int, string>  $tokens  Expo push tokens (ExponentPushToken[xxx])
     * @param  array<string, mixed>  $data  Optional data payload
     * @return array<int, array{status: string, id?: string, message?: string, details?: array}>
     */
    public function sendPushMessages(array $tokens, string $title, string $body = '', array $data = []): array
    {
        $messages = array_map(
            fn (string $to) => array_filter([
                'to' => $to,
                'title' => $title,
                'body' => $body,
                'data' => $data ?: null,
            ], fn ($v) => $v !== null && $v !== ''),
            $tokens
        );

        $batches = array_chunk($messages, 100);
        $allTickets = [];

        foreach ($batches as $batch) {
            $response = Http::acceptJson()
                ->contentType('application/json')
                ->post(self::EXPO_PUSH_URL, $batch);

            if (! $response->successful()) {
                Log::warning('Expo push request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                foreach ($batch as $_) {
                    $allTickets[] = ['status' => 'error', 'message' => 'Request failed'];
                }
                continue;
            }

            $json = $response->json();
            $tickets = $json['data'] ?? [];
            foreach ($tickets as $ticket) {
                $allTickets[] = $ticket;
            }
            if (! empty($json['errors'])) {
                Log::warning('Expo push errors', ['errors' => $json['errors']]);
            }
        }

        return $allTickets;
    }
}
