<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhooks\PaddleController;

// Single URL for all Paddle events (transaction.*, customer.*, subscription.*, etc.)
Route::post('/webhooks/paddle', [PaddleController::class, 'handle'])->name('webhooks.paddle');
