<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipments\src\Http\Controllers\InsurancePolicyController;
use Modules\Shipments\src\Http\Controllers\LogisticsPointController;
use Modules\Shipments\src\Http\Controllers\ShipmentController;
use Modules\Shipments\src\Http\Controllers\TaxController;
use Modules\Shipments\src\Http\Controllers\TrackingStatusController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tracking-statuses', [TrackingStatusController::class, 'index'])->name('tracking-statuses.index');
    Route::apiResource('taxes', TaxController::class)->only(['index']);
    Route::apiResource('insurance-policies', InsurancePolicyController::class)->only(['index']);
    Route::apiResource('logistics-points', LogisticsPointController::class)->only(['index']);
    Route::apiResource('shipments', ShipmentController::class)->except(['destroy']);
});
