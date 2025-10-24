<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validate inputs
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // determine whether user typed email or username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // merge login field into credentials array
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        // Try pengguna
        if (Auth::guard('pengguna')->attempt($credentials)) {
            return redirect()->route('pengguna.dashboard');
        }

        // Try admin 
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withInput($request->only('login'))
            ->withErrors([
                'login' => 'Data tidak sesuai',
            ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('pengguna')->check()) {
            Auth::guard('pengguna')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}