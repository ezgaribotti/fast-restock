<?php

use Modules\Payment\src\Http\Controllers\PaymentController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('payments', PaymentController::class)->except('update', 'destroy');
});
