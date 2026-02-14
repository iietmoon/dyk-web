<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserOtp;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AutheticationController extends Controller
{
    public function __construct(
        private EmailService $emailService
    ) {}

    /**
     * Get the currently authenticated user.
     *
     * @group Profile
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return HttpStatusCode::OK->toResponse(['data' => $user]);
    }

    /**
     * Update the authenticated user's profile (name, birthdate, gender, topics).
     *
     * @group Profile
     * @bodyParam name string required Max 255. Example: John Doe
     * @bodyParam birthdate string required Date (Y-m-d). Example: 1990-01-15
     * @bodyParam gender string required Max 255. Example: male
     * @bodyParam topics array required Array of topic IDs. Example: [1, 2, 3]
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'topics' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();

        $user->update([
            'name' => $request->input('name'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'topics' => $request->input('topics'),
        ]);

        return HttpStatusCode::OK->toResponse([
            'message' => 'Profile updated successfully.',
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    /**
     * Request OTP (send login code to email). Sends a 4-digit OTP; expires in 10 minutes.
     *
     * @group Authentication
     * @unauthenticated
     * @bodyParam email string required Valid email address. Example: user@example.com
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $this->emailService->sendOtp($request->input('email'));

        return HttpStatusCode::OK->toResponse([
            'message' => 'OTP sent to your email.',
        ]);
    }

    /**
     * Verify OTP and get Bearer token. Creates or finds the user. Use the token in Authorization header for protected routes.
     *
     * @group Authentication
     * @unauthenticated
     * @bodyParam email string required Same email used in authenticate. Example: user@example.com
     * @bodyParam otp string required 4-character OTP from email. Example: 1234
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:4'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $otpRecord = UserOtp::where('email', $request->input('email'))
            ->where('otp', $request->input('otp'))
            ->first();

        if (! $otpRecord) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => [
                    'otp' => ['Invalid OTP.'],
                ],
            ]);
        }

        if ($otpRecord->expires_at->isPast()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => [
                    'otp' => ['OTP expired.'],
                ],
            ]);
        }

        $user = User::where('email', $request->input('email'))->first();
        $is_new_user = false;

        if (! $user) {
            $user = User::create([
                'name' => Str::before($request->input('email'), '@'),
                'email' => $request->input('email'),
                'email_verified_at' => now(),
            ]);
            $is_new_user = true;
        }

        $user->update([
            'email_verified_at' => now(),
        ]);

        $expiresAt = now()->addMinutes(config('api.token_expiry_minutes', 60));
        $newAccessToken = $user->createToken('auth_token', ['*'], $expiresAt);

        return HttpStatusCode::OK->toResponse([
            'message' => 'OTP verified successfully.',
            'data' => [
                'token' => $newAccessToken->plainTextToken,
                'user' => $user,
                'is_new_user' => $is_new_user,
            ],
        ]);
    }

    /**
     * Finish registration (name, birthdate, gender, topics). Use after first login when is_new_user was true.
     *
     * @group Profile
     * @bodyParam name string required Max 255. Example: John Doe
     * @bodyParam birthdate string required Date (Y-m-d). Example: 1990-01-15
     * @bodyParam gender string required Max 255. Example: male
     * @bodyParam topics array required Array of topic IDs. Example: [1, 2, 3]
     */
    public function finishRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'topics' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();

        $user->update([
            'name' => $request->input('name'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'topics' => $request->input('topics'),
        ]);

        return HttpStatusCode::OK->toResponse([
            'message' => 'Registration finished successfully.',
            'data' => [
                'user' => $user,
            ],
        ]);
    }

    /**
     * Log out: revoke all tokens for the current user.
     *
     * @group Profile
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return HttpStatusCode::OK->toResponse([
            'message' => 'Logged out successfully.',
        ]);
    }
}
