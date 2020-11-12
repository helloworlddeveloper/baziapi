<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuth extends Middleware
{
    public function handle($request, Closure $next)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return $next($request);
        }
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return response()->json([
            'message' => 'Unauthorized',
        ]);
    }
}
