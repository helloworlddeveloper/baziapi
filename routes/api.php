<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:30,1')->group(function () {     //1小时访问频率为30次
    Route::middleware('auth:api')->group(function () {
        //Route::post('/', [\App\Http\Controllers\Api\HomeController::class, 'userInfo'])->name('home');
        Route::post('/logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout'])->name('logout');

        Route::post('/refresh', [\App\Http\Controllers\Api\RegisterController::class, 'refresh'])->name('refresh');

        Route::post('/resetPassword', [\App\Http\Controllers\Api\PasswordController::class, 'resetPassword'])->name('resetPassword');

        Route::post('/avatar', [\App\Http\Controllers\Api\UserAvatarController::class, 'upload'])->name('avatar');

        Route::post('/TopLogo', [\App\Http\Controllers\Api\UserAvatarController::class, 'TopLogo'])->name('topLogo');

        Route::post('/title', [\App\Http\Controllers\Api\TitleController::class, 'store'])->name('title');

        Route::prefix('/mingpan')->group(function () {
            Route::post('/store', [\App\Http\Controllers\Api\MingPanController::class, 'store'])->name('store');
            Route::post('/show', [\App\Http\Controllers\Api\MingPanController::class, 'show'])->name('show');
            Route::post('/del', [\App\Http\Controllers\Api\MingPanController::class, 'del'])->name('del');
            Route::post('/edit', [\App\Http\Controllers\Api\MingPanController::class, 'edit'])->name('edit');
        });

        Route::post('getMessage', [\App\Http\Controllers\Api\GetMessageController::class, 'getMessage']);

        Route::post('isread', [\App\Http\Controllers\Api\GetMessageController::class, 'isread']);
        Route::post('isrevoke', [\App\Http\Controllers\Api\GetMessageController::class, 'isrevoke']);

        Route::post('pisread', [\App\Http\Controllers\Api\GetMessageController::class, 'privateIsRead']);
        Route::post('pisrevoke', [\App\Http\Controllers\Api\GetMessageController::class, 'privateIsRevoke']);

    });

    Route::post('/register', [\App\Http\Controllers\Api\RegisterController::class, 'register'])->name('register');
    Route::get('activityMail', [\App\Http\Controllers\Api\RegisterController::class, 'activityMail'])->name('activityMail');
    Route::post('/login', [\App\Http\Controllers\Api\RegisterController::class, 'login'])->middleware('CheckMail')->name('login');

    //发送重置密码链接
    Route::post('/changePassword', [\App\Http\Controllers\Api\PasswordController::class, 'changePassword'])->name('changePassword');
    //提交重置密码
    Route::post('/doChangePassword', [\App\Http\Controllers\Api\PasswordController::class, 'doChangePassword'])->name('doChangePassword');

    //admin---------------------------------------------------------------------------
    Route::post('/admin8341login', [\App\Http\Controllers\Admin\AdminLoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {

        Route::prefix('/admin')->group(function () {
            Route::post('logout', [\App\Http\Controllers\Admin\LogoutController::class, 'logout']);

            Route::post('usersAll', [\App\Http\Controllers\Admin\UserDataController::class, 'getAll']);
            Route::post('edit', [\App\Http\Controllers\Admin\UserDataController::class, 'edit']);

            Route::post('mingPan', [\App\Http\Controllers\Admin\MingPanDataController::class, 'getAll']);

            Route::post('msgAll', [\App\Http\Controllers\Admin\MessageController::class, 'getAll']);
            Route::post('msgAdd', [\App\Http\Controllers\Admin\MessageController::class, 'add']);
            Route::post('msgEdit', [\App\Http\Controllers\Admin\MessageController::class, 'edit']);
            Route::post('msgDel', [\App\Http\Controllers\Admin\MessageController::class, 'del']);
            Route::post('msgSend', [\App\Http\Controllers\Admin\MessageController::class, 'send']);
        });

    });
});
