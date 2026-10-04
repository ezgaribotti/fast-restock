<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\src\Http\Controllers\CustomerAddressController;
use Modules\Customer\src\Http\Controllers\CustomerController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('customer-addresses', CustomerAddressController::class)->only(['store', 'destroy']);
});
