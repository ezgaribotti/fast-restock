<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\src\Http\Controllers\CategoryController;
use Modules\Inventory\src\Http\Controllers\ProductController;
use Modules\Inventory\src\Http\Controllers\ProductImageController;
use Modules\Inventory\src\Http\Controllers\PurchaseOrderController;
use Modules\Inventory\src\Http\Controllers\StockController;
use Modules\Inventory\src\Http\Controllers\StockRuleController;
use Modules\Inventory\src\Http\Controllers\SupplierController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('categories', CategoryController::class)->except('update');
    Route::apiResource('suppliers', SupplierController::class)->except('update');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-images', ProductImageController::class)->only(['store', 'destroy']);
    Route::apiResource('stocks', StockController::class);
    Route::apiResource('stock-rules', StockRuleController::class);
    Route::apiResource('purchase-orders', PurchaseOrderController::class)->except(['store', 'destroy']);
});
