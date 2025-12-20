<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\src\Http\Controllers\CountryController;
use Modules\Customers\src\Http\Controllers\CustomerAddressController;
use Modules\Customers\src\Http\Controllers\CustomerController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('customer-addresses', CustomerAddressController::class)->only(['store', 'destroy']);
});
