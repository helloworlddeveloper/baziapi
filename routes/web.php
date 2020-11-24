<?php

use Illuminate\Support\Facades\Route;

//事件
//Route::get('/sub', [\App\Http\Controllers\Api\webSocket\SystemMessageController::class, 'systemMessage'])->name('sub');

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);
Route::get('/test2', [\App\Http\Controllers\TestController::class, 'test2']);

//公共广播
Route::get('/sysMsg', function () {
    event(new \App\Events\SystemMessage(['title' => '系统信息', 'msg' => '公共信息', 'color' => 'error--text']));
})->name('sysMsg');

//私有广播
Route::get('/regUser', [\App\Http\Controllers\Api\webSocket\RegisterUserEvent::class, 'sendMsg'])->name('regUser');

Route::fallback(function () {
    return abort(403, 'Unauthorized');
});

