<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\OtpController;
use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Legacy auth (password-based) - consider migrating to v1 OTP
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

/*
|--------------------------------------------------------------------------
| API v1 - OTP magic link flow (login + register)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    // Public: get list of topics for registration
    Route::get('/topics', [RegisterController::class, 'topics']);

    // OTP: send 4-digit code to email
    Route::post('/otp/send', [OtpController::class, 'send']);

    // OTP: verify code → if registered: token; if not: registration_token + requires_profile
    Route::post('/otp/verify', [OtpController::class, 'verify']);

    // New users: complete profile with registration_token from otp/verify
    Route::post('/register/complete', [RegisterController::class, 'complete']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
