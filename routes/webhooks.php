<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhooks\PaddleController;

Route::post('/webhooks/paddle/subscription-created', [PaddleController::class, 'subscriptionCreated'])
    ->name('webhooks.paddle.subscription-created');
