<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HideFootController extends Controller
{
    public function hideFoot(Request $request)
    {
        $user = User::find(\Auth::id());
        //记录底部版权隐藏状态
        if ($request->hideFoot === false) {
            $user->bak_5 = 0;
            $user->save();
        } else {
            $user->bak_5 = 1;
            $user->save();
        }

        return response()->json([
            'hideFoot' => (int)$user->bak_5,
            'aaa' => $request->all()
        ]);
    }
}
