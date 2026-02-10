<?php
namespace App\Http\Controllers\Api\v1;

    use App\Enums\HttpStatusCode;
    use App\Http\Controllers\Controller;
    use App\Services\EmailService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Str;
    use App\Models\UserOtp;
    use App\Models\User;

    class AutheticationController extends Controller
    {
        public function __construct(
            private EmailService $emailService
        ) {}

        public function me(Request $request)
        {
            $user = $request->user();

            return HttpStatusCode::OK->toResponse(['data' => $user]);
        }

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
         * Send a 4-character OTP to the given email with an expiration time of 10 minutes.
         * Public route (no auth). Stores OTP in user_otps and sends email.
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

            $otpRecord = UserOtp::where('email', $request->input('email'))->where('otp', $request->input('otp'))->first();

            if (!$otpRecord) {
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
            };

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

        public function logout(Request $request)
        {
            $user = $request->user();
            $user->tokens()->delete();

            return HttpStatusCode::OK->toResponse([
                'message' => 'Logged out successfully.',
            ]);
        }
    }
