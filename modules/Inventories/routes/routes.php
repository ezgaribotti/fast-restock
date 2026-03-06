<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventories\src\Http\Controllers\CategoryController;
use Modules\Inventories\src\Http\Controllers\ProductController;
use Modules\Inventories\src\Http\Controllers\ProductImageController;
use Modules\Inventories\src\Http\Controllers\SupplierController;
use Modules\Inventories\src\Http\Controllers\WarehouseController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class)->only('index');
    Route::apiResource('suppliers', SupplierController::class)->only('index');
    Route::apiResource('warehouses', WarehouseController::class)->only('index');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-images', ProductImageController::class)->only(['store', 'destroy']);
});
