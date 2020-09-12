<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/', [\App\Http\Controllers\Api\HomeController::class, 'userInfo']);
    Route::post('/logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout']);
});


Route::post('/login', [\App\Http\Controllers\Api\RegisterController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'register']);
