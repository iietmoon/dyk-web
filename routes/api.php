<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuthetication;
use App\Http\Controllers\Api\v1\AutheticationController;
use App\Http\Controllers\Payments\PaymentController;
/*
|--------------------------------------------------------------------------
| API v1
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    // Auth (public)
    Route::post('/authenticate', [AutheticationController::class, 'authenticate'])->name('api.v1.authenticate');
    Route::post('/verify-otp', [AutheticationController::class, 'verifyOtp'])->name('api.v1.verify-otp');

    Route::middleware(ApiAuthetication::class)->group(function () {
        Route::get('/me', [AutheticationController::class, 'me'])->name('api.v1.me');
        Route::post('/update-profile', [AutheticationController::class, 'updateProfile'])->name('api.v1.update-profile');
        Route::post('/finish-registration', [AutheticationController::class, 'finishRegistration'])->name('api.v1.finish-registration');
        Route::post('/logout', [AutheticationController::class, 'logout'])->name('api.v1.logout');

        // Create payment link (authenticated user + plan)
        Route::post('/payment/create-link', [PaymentController::class, 'createPaymentLink'])->name('api.v1.payment-link.create');
        Route::get('/payment/plans', [PaymentController::class, 'getPlans'])->name('api.v1.payment-plans.get');
    });
});
