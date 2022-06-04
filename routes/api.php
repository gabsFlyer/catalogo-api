<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\MeasurementUnitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::post('auth/signIn', [AuthController::class, 'signIn']);
Route::post('auth/signUp', [AuthController::class, 'signUp']);

Route::middleware(['apiJwt'])->group(function () {
    Route::post('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('measurement-unit', MeasurementUnitController::class);
    Route::apiResource('file', FileController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('user', UserController::class);
});

