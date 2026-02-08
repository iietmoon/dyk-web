<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    /**
     * Send a 4-digit OTP to the given email.
     */
    public function send(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower($validated['email']);
        $otp = (string) random_int(1000, 9999);
        $expiry = config('api.otp_expiry_minutes', 10);

        UserOtp::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes($expiry),
                'attempts' => 0,
            ]
        );

        Mail::to($email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'OTP sent to your email.',
            'expires_in_minutes' => $expiry,
        ]);
    }

    /**
     * Verify OTP. If user exists → return token (login). If not → return registration_token for profile completion.
     */
    public function verify(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:4'],
        ]);

        $email = strtolower($validated['email']);
        $otp = $validated['otp'];

        $userOtp = UserOtp::where('email', $email)->first();

        if (! $userOtp) {
            throw ValidationException::withMessages([
                'otp' => ['OTP expired or invalid. Please request a new code.'],
            ]);
        }

        $maxAttempts = 5;
        if ($userOtp->attempts >= $maxAttempts) {
            $userOtp->delete();
            throw ValidationException::withMessages([
                'otp' => ['Too many failed attempts. Please request a new code.'],
            ]);
        }

        if (! $userOtp->isValid()) {
            $userOtp->delete();
            throw ValidationException::withMessages([
                'otp' => ['OTP expired or invalid. Please request a new code.'],
            ]);
        }

        if ($userOtp->otp !== $otp) {
            $userOtp->increment('attempts');
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP.'],
            ]);
        }

        $userOtp->delete();

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->tokens()->where('name', 'mobile-app')->delete();
            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'registered' => true,
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        $registrationToken = encrypt([
            'email' => $email,
            'exp' => now()->addMinutes(config('api.registration_token_expiry_minutes', 15))->timestamp,
        ]);

        return response()->json([
            'registered' => false,
            'requires_profile' => true,
            'registration_token' => $registrationToken,
            'message' => 'Please complete your profile (name, birthdate, gender, topics).',
        ]);
    }
}
