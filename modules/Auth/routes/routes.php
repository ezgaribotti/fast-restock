<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\AuthController;
use Modules\Auth\src\Http\Controllers\OperatorController;
use Modules\Auth\src\Http\Controllers\PermissionController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/forgot-password', 'sendResetLink')->name('forgot-password');
    Route::post('/reset-password/{token}', 'resetPassword')->name('reset-password');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('operators', OperatorController::class);
    Route::post('/sync-permissions', [OperatorController::class, 'syncPermissions'])->name('operators.sync-permissions');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/current-operator', 'currentOperator')->name('current-operator');
    });
});
