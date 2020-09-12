<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function userInfo()
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
