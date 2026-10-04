<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\AuthController;
use Modules\Auth\src\Http\Controllers\OperatorController;
use Modules\Auth\src\Http\Controllers\PermissionController;

Route::name('auth.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/forgot-password', 'forgotPassword')->name('forgot-password');
        Route::post('/reset-password', 'resetPassword')->name('reset-password');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
            Route::get('/current-operator', 'currentOperator')->name('current-operator');
        });
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('operators', OperatorController::class);
    Route::post('/sync-permissions', [OperatorController::class, 'syncPermissions'])->name('operators.sync-permissions');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
});
