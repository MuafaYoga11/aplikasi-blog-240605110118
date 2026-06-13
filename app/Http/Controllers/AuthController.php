<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['user_name' => $credentials['user_name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            
            // Set login time in session
            session(['login_time' => Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('D MMMM YYYY, HH:mm')]);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ])->onlyInput('user_name');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
