<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OTP expiry (minutes)
    |--------------------------------------------------------------------------
    */
    'otp_expiry_minutes' => env('API_OTP_EXPIRY_MINUTES', 10),

    /*
    |--------------------------------------------------------------------------
    | Registration token expiry (minutes) - for completing profile after OTP
    |--------------------------------------------------------------------------
    */
    'registration_token_expiry_minutes' => env('API_REGISTRATION_TOKEN_EXPIRY_MINUTES', 15),

];
