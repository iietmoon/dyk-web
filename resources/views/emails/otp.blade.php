<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your login code</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 400px; margin: 0 auto; padding: 20px;">
    <p>Use this code to sign in:</p>
    <p style="font-size: 28px; font-weight: bold; letter-spacing: 8px; margin: 24px 0;">{{ $otp }}</p>
    <p style="color: #666; font-size: 14px;">This code expires in {{ config('api.otp_expiry_minutes', 10) }} minutes. If you didn't request this, you can ignore this email.</p>
</body>
</html>
