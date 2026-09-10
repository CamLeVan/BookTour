<?php

namespace App\Http\Controllers\Spadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('spadmin.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('spadmin')->attempt($credentials)) {
            $user = Auth::guard('spadmin')->user();
            
            if ($user->role !== 'spadmin') {
                Auth::guard('spadmin')->logout();
                return back()->withErrors([
                    'email' => 'Chỉ Super Admin mới có quyền truy cập.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('spadmin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('spadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('spadmin.login');
    }
}