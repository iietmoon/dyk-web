<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhooks\PaddleController;

include __DIR__ . '/website.php';
include __DIR__ . '/webhooks.php';

Route::post('webhooks/paddle/subscription-created', [PaddleController::class, 'subscriptionCreated'])
    ->name('webhooks.paddle.subscription-created');
