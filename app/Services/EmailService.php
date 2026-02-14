<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Generate a 4-character numeric OTP.
     */
    public function generateOtp(): string
    {
        return (string) random_int(1000, 9999);
    }

    /**
     * Send OTP email to the given address.
     * Creates or updates the user_otps record and sends the email.
     *
     * @return array{otp_record: UserOtp, expires_at: \Illuminate\Support\Carbon}
     * @throws \Throwable
     */
    public function sendOtp(string $email): array
    {
        $otp = $this->generateOtp();
        $expiresAt = now()->addMinutes(config('api.otp_expiry_minutes', 10));

        $otpRecord = UserOtp::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'attempts' => 0,
            ]
        );

        Mail::to($email)->send(new OtpMail($otp));

        return [
            'otp_record' => $otpRecord,
            'expires_at' => $expiresAt,
        ];
    }

    /**
     * Send a welcome email to the user (e.g. after successful subscription).
     */
    public function sendWelcomeEmail(User $user): void
    {
        Mail::to($user->email)->send(new WelcomeMail($user));
    }
}
