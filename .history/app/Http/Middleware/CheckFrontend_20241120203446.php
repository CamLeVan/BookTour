<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFrontend
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('message', 'Bạn đang đăng nhập với tư cách Admin');
            }
            if ($user->role === 'spadmin') {
                return redirect()->route('spadmin.dashboard')->with('message', 'Bạn đang đăng nhập với tư cách Super Admin');
            }
        }
        return $next($request);
    }
}
