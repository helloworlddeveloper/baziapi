<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return $next($request);
        }
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return abort(403, 'Unauthorized');
    }
}
