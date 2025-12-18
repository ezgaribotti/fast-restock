<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventories\src\Http\Controllers\CategoryController;
use Modules\Inventories\src\Http\Controllers\ProductController;
use Modules\Inventories\src\Http\Controllers\ProductImageController;
use Modules\Inventories\src\Http\Controllers\SupplierController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-images', ProductImageController::class)->only(['store', 'destroy']);
});
