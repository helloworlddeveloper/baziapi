<?php

namespace App\Http\Controllers\Api\webSocket;

use App\Events\UserSubscribe;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SystemMessageController extends Controller
{
    public function systemMessage(Request $request)
    {
        $user = User::find($request->id);
        event(new UserSubscribe($user));
    }
}
