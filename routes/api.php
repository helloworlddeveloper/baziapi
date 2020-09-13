<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/', [\App\Http\Controllers\Api\HomeController::class, 'userInfo']);
    Route::post('/logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Api\RegisterController::class, 'refresh']);

    Route::post('/changePassword', [\App\Http\Controllers\Api\PasswordController::class, 'changePassword']);
});


Route::post('/login', [\App\Http\Controllers\Api\RegisterController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'register']);
