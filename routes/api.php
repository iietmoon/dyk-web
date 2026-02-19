<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuthetication;
use App\Http\Middleware\AgentBearerToken;
use App\Http\Middleware\OptionalApiAuthentication;
use App\Http\Controllers\Api\v1\ArticleBookmarkController;
use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\ArticleLikeController;
use App\Http\Controllers\Api\v1\AutheticationController;
use App\Http\Controllers\Api\v1\ExpoPushTokenController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\ReportController;
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

        // Article likes (like / unlike)
        Route::get('/likes', [ArticleLikeController::class, 'index'])->name('api.v1.likes.index');
        Route::post('/likes', [ArticleLikeController::class, 'store'])->name('api.v1.likes.store');
        Route::delete('/likes/{articleId}', [ArticleLikeController::class, 'destroy'])->name('api.v1.likes.destroy');

        // Report / signal a problem (with motif)
        Route::post('/reports', [ReportController::class, 'store'])->name('api.v1.reports.store');

        // Notifications (list, show, read, read all, delete, delete all)
        Route::get('/notifications', [NotificationController::class, 'index'])->name('api.v1.notifications.index');
        Route::patch('/notifications/read-all', [NotificationController::class, 'readAll'])->name('api.v1.notifications.read-all');
        Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('api.v1.notifications.destroy-all');
        Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('api.v1.notifications.show');
        Route::patch('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('api.v1.notifications.read');
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('api.v1.notifications.destroy');

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
    // Articles: list (all or by ?status=), list published only, CRUD
    Route::get('/articles', [N8nController::class, 'index'])->name('api.agent.articles.index');
    Route::get('/articles/published', [N8nController::class, 'getAllArticles'])->name('api.agent.articles.published');
    Route::get('/articles/{article}', [N8nController::class, 'show'])->name('api.agent.articles.show');
    Route::post('/articles', [N8nController::class, 'store'])->name('api.agent.articles.store');
    Route::put('/articles/{article}', [N8nController::class, 'update'])->name('api.agent.articles.update');
    Route::patch('/articles/{article}', [N8nController::class, 'update'])->name('api.agent.articles.patch');
    Route::delete('/articles/{article}', [N8nController::class, 'destroy'])->name('api.agent.articles.destroy');

    // Notifications: send Expo push to users (or broadcast)
    Route::post('/notifications/send', [N8nController::class, 'sendNotification'])->name('api.agent.notifications.send');

    // Upload: image → returns URL
    Route::post('/upload/image', [N8nController::class, 'uploadImage'])->name('api.agent.upload.image');
});
