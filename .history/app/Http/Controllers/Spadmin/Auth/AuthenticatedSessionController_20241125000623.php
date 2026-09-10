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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role !== 'spadmin') {
                Auth::logout();
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
}