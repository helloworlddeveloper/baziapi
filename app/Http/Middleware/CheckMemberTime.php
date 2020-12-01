<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckMemberTime
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(\Auth::id());
        //判断是否订阅
        if ($user->user_type == 0) {
            return response()->json([
                'message' => '对不起，需要订阅用户。',
            ], 403);
        }
        return $next($request);
    }
}
