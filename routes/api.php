<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuthetication;
use App\Http\Middleware\AgentBearerToken;
use App\Http\Middleware\OptionalApiAuthentication;
use App\Http\Controllers\Api\v1\ArticleBookmarkController;
use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\AutheticationController;
use App\Http\Controllers\Api\v1\ExpoPushTokenController;
use App\Http\Controllers\Agents\N8nController;
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
    Route::post('/login-google', [AutheticationController::class, 'loginWithGoogle'])->name('api.v1.login-google');
    Route::post('/login-apple', [AutheticationController::class, 'loginWithApple'])->name('api.v1.login-apple');

    Route::middleware(ApiAuthetication::class)->group(function () {
        Route::get('/me', [AutheticationController::class, 'me'])->name('api.v1.me');
        Route::post('/update-profile', [AutheticationController::class, 'updateProfile'])->name('api.v1.update-profile');
        Route::post('/update-settings', [AutheticationController::class, 'updateSettings'])->name('api.v1.update-settings');
        Route::post('/finish-registration', [AutheticationController::class, 'finishRegistration'])->name('api.v1.finish-registration');
        Route::post('/logout', [AutheticationController::class, 'logout'])->name('api.v1.logout');

        // Create payment link (authenticated user + plan)
        Route::post('/payment/create-link', [PaymentController::class, 'createPaymentLink'])->name('api.v1.payment-link.create');
        Route::get('/payment/plans', [PaymentController::class, 'getPlans'])->name('api.v1.payment-plans.get');
        Route::get('/articles', [ArticleController::class, 'index'])->name('api.v1.articles.index');
        Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('api.v1.articles.show');

        // Article bookmarks (list / save / remove)
        Route::get('/bookmarks', [ArticleBookmarkController::class, 'index'])->name('api.v1.bookmarks.index');
        Route::post('/bookmarks', [ArticleBookmarkController::class, 'store'])->name('api.v1.bookmarks.store');
        Route::delete('/bookmarks', [ArticleBookmarkController::class, 'destroyMultiple'])->name('api.v1.bookmarks.destroy-multiple');
        Route::delete('/bookmarks/{articleId}', [ArticleBookmarkController::class, 'destroy'])->name('api.v1.bookmarks.destroy');

        // Expo push token (for sending notifications to mobile app)
        Route::post('/expo-push-token', [ExpoPushTokenController::class, 'store'])->name('api.v1.expo-push-token.store');
    });
});

/*
|--------------------------------------------------------------------------
| API Agent (e.g. n8n) – Bearer token from .env, no DB
|--------------------------------------------------------------------------
*/
Route::prefix('agent')->middleware(AgentBearerToken::class)->group(function () {
    Route::get('/articles', [N8nController::class, 'getAllArticles'])->name('api.agent.articles');
});
