<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

Route::post('signIn', [AuthController::class, 'login']);

Route::middleware(['apiJwt'])->group(function () {
    Route::apiResource('users', UserController::class);
});

