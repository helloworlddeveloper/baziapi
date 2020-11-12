<?php

namespace App\Http\Controllers\Api\webSocket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterUserEvent extends Controller
{
    public function sendMsg(Request $request)
    {
        $user = \App\Models\User::query()->findOrFail($request->id);
        $msg = ['title' => '我是用户:' . $request->id . '的私有消息', 'msg' => '啊手动阀手动阀手动阀撒旦发射点发', 'color' => 'orange--text'];
        broadcast(new \App\Events\RegisterUserEvent($user, $msg));
    }
}
