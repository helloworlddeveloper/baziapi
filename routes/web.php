<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AdminLoginController::class, 'login'])
        ->name('admin.login');
    Route::get('logout', [\App\Http\Controllers\Admin\AdminHomeController::class, 'logout'])
        ->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::match(['post', 'get'], 'home', [\App\Http\Controllers\Admin\AdminHomeController::class, 'home'])
            ->name('admin.home');
        Route::match(['post', 'get'], 'list', [\App\Http\Controllers\Admin\AdminHomeController::class, 'list'])
            ->name('admin.list');
    });
});

Route::get('/sub', [\App\Http\Controllers\Api\webSocket\SystemMessageController::class, 'systemMessage'])->name('sub');

Route::get('/sysMsg', function () {
    event(new \App\Events\SystemMessage(['title' => 10, 'msg' => 'Tom']));
})->name('sysMsg');

Route::fallback(function () {
    return abort(403, 'Unauthorized');
});

