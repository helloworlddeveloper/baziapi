<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:30,1')->group(function () {     //1小时访问频率为30次
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Api\RegisterController::class, 'logout'])->name('logout');

        Route::post('/refresh', [\App\Http\Controllers\Api\RegisterController::class, 'refresh'])->name('refresh');

        Route::post('/resetPassword', [\App\Http\Controllers\Api\PasswordController::class, 'resetPassword'])->name('resetPassword');

        Route::post('/avatar', [\App\Http\Controllers\Api\UserAvatarController::class, 'upload'])->middleware('CheckMemberTime')->name('avatar');

        Route::post('/TopLogo', [\App\Http\Controllers\Api\UserAvatarController::class, 'TopLogo'])->middleware('CheckMemberTime')->name('topLogo');

        Route::post('/title', [\App\Http\Controllers\Api\TitleController::class, 'store'])->middleware('CheckMemberTime')->name('title');
        Route::post('/hideFoot', [\App\Http\Controllers\Api\HideFootController::class, 'hideFoot'])->middleware('CheckMemberTime');

        Route::prefix('/mingpan')->group(function () {
            Route::post('/store', [\App\Http\Controllers\Api\MingPanController::class, 'store'])->middleware('CheckMemberTime')->name('store');
            Route::post('/show', [\App\Http\Controllers\Api\MingPanController::class, 'show'])->name('show');
            Route::post('/del', [\App\Http\Controllers\Api\MingPanController::class, 'del'])->name('del');
            Route::post('/edit', [\App\Http\Controllers\Api\MingPanController::class, 'edit'])->name('edit');
        });

        Route::post('getMessage', [\App\Http\Controllers\Api\GetMessageController::class, 'getMessage']);

        Route::post('isread', [\App\Http\Controllers\Api\GetMessageController::class, 'isread']);
        Route::post('isrevoke', [\App\Http\Controllers\Api\GetMessageController::class, 'isrevoke']);

        Route::post('pisread', [\App\Http\Controllers\Api\GetMessageController::class, 'privateIsRead']);
        Route::post('pisrevoke', [\App\Http\Controllers\Api\GetMessageController::class, 'privateIsRevoke']);

        //用户留言部分
        Route::post('userMessageSend', [\App\Http\Controllers\Message\UserMessageController::class, 'store']);
        Route::post('userMessageGet', [\App\Http\Controllers\Message\UserMessageController::class, 'get']);
        Route::post('userMessageDel', [\App\Http\Controllers\Message\UserMessageController::class, 'delMessage']);
        Route::post('noReadReplyCount', [\App\Http\Controllers\Message\UserMessageController::class, 'noReadReply']);

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

    //system---------------------------------------------------------------------------
    Route::post('/getAll', [\App\Http\Controllers\Admin\SystemController::class, 'getAll']);
    Route::post('/getStatic', [\App\Http\Controllers\Admin\SystemController::class, 'getStatic']);
    Route::post('/getPayDesc', [\App\Http\Controllers\Admin\SystemController::class, 'getPayDesc']);


    Route::middleware('auth:admin')->group(function () {

        Route::prefix('/admin')->group(function () {
            Route::post('logout', [\App\Http\Controllers\Admin\LogoutController::class, 'logout']);

            Route::post('usersAll', [\App\Http\Controllers\Admin\UserDataController::class, 'getAll']);
            Route::post('edit', [\App\Http\Controllers\Admin\UserDataController::class, 'edit']);
            Route::post('setMember', [\App\Http\Controllers\Admin\UserDataController::class, 'setMember']);

            Route::post('mingPan', [\App\Http\Controllers\Admin\MingPanDataController::class, 'getAll']);

            Route::post('msgAll', [\App\Http\Controllers\Admin\MessageController::class, 'getAll']);
            Route::post('msgAdd', [\App\Http\Controllers\Admin\MessageController::class, 'add']);
            Route::post('msgEdit', [\App\Http\Controllers\Admin\MessageController::class, 'edit']);
            Route::post('msgDel', [\App\Http\Controllers\Admin\MessageController::class, 'del']);
            Route::post('msgSend', [\App\Http\Controllers\Admin\MessageController::class, 'send']);

            Route::post('/saveHome', [\App\Http\Controllers\Admin\SystemController::class, 'saveHome']);
            Route::post('/saveSub', [\App\Http\Controllers\Admin\SystemController::class, 'saveSub']);
            Route::post('/saveStatic', [\App\Http\Controllers\Admin\SystemController::class, 'saveStatic']);
            Route::post('/savePayDesc', [\App\Http\Controllers\Admin\SystemController::class, 'savePayDesc']);
            Route::post('/delPayDesc', [\App\Http\Controllers\Admin\SystemController::class, 'delPayDesc']);

            //admin回复留言
            Route::post('/getAllCount', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'getAllCount']);
            Route::post('/getMessageAll', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'getAll']);
            Route::post('/getMessageAllNew', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'getAllNew']);
            Route::post('/saveReply', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'saveReply']);
            Route::post('/delMessage', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'delMessage']);
            Route::post('/readMessage', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'readMessage']);
            Route::post('/editReplyMessage', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'editReplyMessage']);
            Route::post('/delReplyMessage', [\App\Http\Controllers\Message\ReplyUserMessageController::class, 'delReplyMessage']);
        });

    });
});
