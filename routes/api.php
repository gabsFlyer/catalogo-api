<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EnterpriseController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\MeasurementUnitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CurrentFlyerController;
use App\Http\Controllers\Api\FlyerController;
use Illuminate\Support\Facades\Artisan;

Route::post('auth/signIn', [AuthController::class, 'signIn']);
Route::post('auth/signUp', [AuthController::class, 'signUp']);

Route::middleware(['apiJwt'])->group(function () {
    Route::post('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);

    Route::apiResource('enterprise', EnterpriseController::class);

    Route::apiResource('file', FileController::class);
    Route::post('file/rotate/{id}', [FileController::class, 'rotate']);

    Route::apiResource('flyer', FlyerController::class);
    Route::apiResource('measurement-unit', MeasurementUnitController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('user', UserController::class);
});

Route::get('/current-flyer', [CurrentFlyerController::class, 'getCurrentFlyer']);

Route::post('/optimize', function() {
    $result = Artisan::call('optimize:clear');
    return response()->json(['message' => $result], 200);
});

Route::post('/storage-link', function() {
    $result = Artisan::call('storage:link');
    return response()->json(['message' => $result], 200);
});
