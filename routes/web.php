<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('register');
// });

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Auth routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:pengguna')->get('/pengguna/dashboard', function () {
    return view('pengguna.dashboard');
})->name('pengguna.dashboard');

Route::middleware('auth:admin')->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');