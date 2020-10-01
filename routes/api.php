<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::post('/', [\App\Http\Controllers\Api\HomeController::class, 'userInfo'])
            ->name('home');
        Route::post('/logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout'])
            ->name('logout');
        Route::post('/refresh', [\App\Http\Controllers\Api\RegisterController::class, 'refresh'])
            ->name('refresh');

        Route::post('/resetPassword', [\App\Http\Controllers\Api\PasswordController::class, 'resetPassword'])
            ->name('resetPassword');
    });

    Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'register'])
        ->name('register');
    Route::get('activityMail', [\App\Http\Controllers\Api\RegisterController::class, 'activityMail'])
        ->name('activityMail');
    Route::post('/login', [\App\Http\Controllers\Api\RegisterController::class, 'login'])
        ->middleware('CheckMail')->name('login');

//发送重置密码链接
    Route::post('/changePassword', [\App\Http\Controllers\Api\PasswordController::class, 'changePassword'])
        ->name('changePassword');
//提交重置密码
    Route::post('/doChangePassword', [\App\Http\Controllers\Api\PasswordController::class, 'doChangePassword'])
        ->name('doChangePassword');
});
