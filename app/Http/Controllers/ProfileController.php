<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // ambil data user yang sedang login
        return view('home.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('home.edit', compact('user'));
    }

    
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
        'nama' => 'required|string|max:100',
        'no_tlp' => 'required|string|max:15',
        'email' => 'required|email|max:50|unique:pengguna,email,' . $user->id_akun . ',id_akun',
        'password' => 'nullable|string|min:8|confirmed',
        ]);


        $user->nama = $request->nama;
        $user->no_tlp = $request->no_tlp;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            // hapus file lama kalau ada
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            // simpan file baru
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            $user->avatar = 'uploads/avatars/' . $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('home.show')->with('success', 'Profil berhasil diperbarui!');
    }
}