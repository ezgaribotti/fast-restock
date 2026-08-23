<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\src\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('orders', OrderController::class)->except('update', 'destroy');
});
