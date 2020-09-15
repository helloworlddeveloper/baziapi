<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckMail
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('username', $request->username)
            ->firstOr(function () {
                return false;
            });

        //如果找不到用户返回403
        if ($user === false) {
            return response()->json([
                'message' => '账号或密码错误',
            ], 403);
        }

        if ($user->is_activity === 1) {
            return $next($request);
        } else {
            return response()->json([
                'data' => [
                    'message' => '请先到注册邮箱里激活账号。',
                ]
            ], 401);
        }
    }
}
