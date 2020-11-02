<?php

namespace App\Http\Controllers\Api\WebSocker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemMessageController extends Controller
{
    public function systemMessage()
    {
        $userInfo = [
            'username' => \Auth::user()->username,
            'id' => \Auth::user()->id,
            'user_type' => \Auth::user()->user_type
        ];

        return response()->json([
            'data' => $userInfo
        ]);
    }
}
