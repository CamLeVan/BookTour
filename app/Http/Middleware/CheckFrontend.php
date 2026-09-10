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
            if ($user->role === 'admin' || $user->role === 'spadmin') {
                $route = $user->role === 'admin' ? '/admin/dashboard' : '/spadmin/dashboard';
                return redirect($route)->with('warning', 'Bạn đang đăng nhập với tư cách admin. Hãy đăng xuất nếu muốn xem trang người dùng.');
            }
        }
        return $next($request);
    }
}
