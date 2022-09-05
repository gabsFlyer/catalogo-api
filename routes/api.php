<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EnterpriseController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\MeasurementUnitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FlyerController;
use Illuminate\Support\Facades\Artisan;

Route::post('auth/signIn', [AuthController::class, 'signIn']);
Route::post('auth/signUp', [AuthController::class, 'signUp']);

Route::middleware(['apiJwt'])->group(function () {
    Route::post('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);

    Route::apiResource('enterprise', EnterpriseController::class);
    Route::apiResource('file', FileController::class);
    Route::apiResource('flyer', FlyerController::class);
    Route::apiResource('measurement-unit', MeasurementUnitController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('user', UserController::class);
});

Route::get('/optimize', function() {
    Artisan::call('optimize:clear');
    Artisan::call('storage:link');

    return response()->json(['message' => 'tudo feito'], 200);
});
