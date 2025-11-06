<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:30|unique:pengguna',
            'nama' => 'required|string|max:100',
            'no_tlp' => 'required|string|max:15',
            'email' => 'required|email|max:50|unique:pengguna',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Pengguna::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}