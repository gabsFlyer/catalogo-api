<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

Route::post('auth/signIn', [AuthController::class, 'signIn']);
Route::post('auth/signUp', [AuthController::class, 'signUp']);

Route::middleware(['apiJwt'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);
});

