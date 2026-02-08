<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * List available topics (tags) for registration.
     */
    public function topics(Request $request): JsonResponse
    {
        $available = config('topics.available', []);
        $topics = collect($available)->map(fn ($name, $slug) => ['slug' => $slug, 'name' => $name])->values();

        return response()->json(['topics' => $topics]);
    }

    /**
     * Complete registration after OTP: create user with name, birthdate, gender, topics. Return token.
     */
    public function complete(Request $request): JsonResponse
    {
        $allowedSlugs = array_keys(config('topics.available', []));

        $validated = $request->validate([
            'registration_token' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'string', 'in:male,female,other,prefer_not_to_say'],
            'topics' => ['required', 'array'],
            'topics.*' => ['string', 'in:'.implode(',', $allowedSlugs)],
        ]);

        $payload = $this->decryptRegistrationToken($validated['registration_token']);
        $email = $payload['email'];

        if (User::where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'registration_token' => ['This registration has already been completed. Please log in.'],
            ]);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $email,
            'email_verified_at' => now(),
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'topics' => array_values($validated['topics']),
            'password' => Hash::make(Str::random(32)),
        ]);

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    private function decryptRegistrationToken(string $token): array
    {
        try {
            $payload = decrypt($token);
        } catch (\Throwable) {
            throw ValidationException::withMessages([
                'registration_token' => ['Invalid or expired registration link. Please request a new OTP.'],
            ]);
        }

        if (! is_array($payload) || empty($payload['email']) || empty($payload['exp'])) {
            throw ValidationException::withMessages([
                'registration_token' => ['Invalid registration token.'],
            ]);
        }

        if ($payload['exp'] < time()) {
            throw ValidationException::withMessages([
                'registration_token' => ['Registration link expired. Please request a new OTP.'],
            ]);
        }

        return $payload;
    }
}
