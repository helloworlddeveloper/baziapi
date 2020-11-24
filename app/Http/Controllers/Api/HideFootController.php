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
        if ($user->user_type != 1) {
            return response()->json([
                'message' => '您还没有订阅，订阅用户特权。',
            ], 403);
        }

        //记录底部版权隐藏状态
        if ($request->hideFoot == 1) {
            $user->bak_5 = 1;
            $user->save();
        }
        if ($request->hideFoot == 0) {
            $user->bak_5 = 0;
            $user->save();
        }

        return response()->json([
            'hideFoot' => (int)$user->bak_5
        ]);
    }
}
