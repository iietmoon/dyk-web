<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\ExpoPushToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpoPushTokenController extends Controller
{
    /**
     * Register (or update) the current device's Expo push token so the server can send notifications.
     *
     * @group Notifications
     * @bodyParam token string required Expo push token (ExponentPushToken[xxx]). Example: ExponentPushToken[xxxxxxxxxxxxxxxxxxxxxx]
     * @bodyParam platform string optional ios or android. Example: ios
     * @bodyParam device_name string optional Device name for display. Example: iPhone 15
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required', 'string', 'max:255'],
            'platform' => ['sometimes', 'string', 'in:ios,android'],
            'device_name' => ['sometimes', 'nullable', 'string', 'max:100'],
        ], [
            'token.required' => 'Expo push token is required.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();

        $token = ExpoPushToken::updateOrCreate(
            [
                'user_id' => $user->id,
                'token' => $request->input('token'),
            ],
            [
                'platform' => $request->input('platform'),
                'device_name' => $request->input('device_name'),
            ]
        );

        return HttpStatusCode::OK->toResponse([
            'message' => 'Push token registered.',
            'data' => $token,
        ]);
    }
}
