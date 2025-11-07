<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;

/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| User Dashboard & Request Donasi Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:pengguna')->group(function () {
    // Dashboard
    Route::get('/home/dashboard', fn() => view('home.dashboard'))->name('home.dashboard');

    // Request Donasi Routes (STRUKTUR BARU)
    Route::prefix('request-donasi')->name('request-donasi.')->group(function () {
        // Landing Page (Hero Section) - Ini yang muncul pertama dari navbar
        Route::get('/', [RequestController::class, 'landing'])->name('landing');
        
        // Daftar Request yang Disetujui (Card-card dengan Edit & Hapus)
        Route::get('/daftar', [RequestController::class, 'index'])->name('index');
        
        // Form Ajukan Request Baru
        Route::get('/create', [RequestController::class, 'create'])->name('create');
        Route::post('/', [RequestController::class, 'store'])->name('store');
        
        // Status Pengajuan User
        Route::get('/status', [RequestController::class, 'status'])->name('status');
        
        // Detail, Edit, Delete
        Route::get('/{id_request}', [RequestController::class, 'show'])->name('show');
        Route::get('/{id_request}/edit', [RequestController::class, 'edit'])->name('edit');
        Route::put('/{id_request}', [RequestController::class, 'update'])->name('update');
        Route::delete('/{id_request}', [RequestController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/statistics', [DashboardController::class, 'getStatistics'])->name('admin.statistics');

    // Donasi Management
    Route::post('/donasi/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiDonasi'])->name('admin.donasi.verifikasi');
    Route::post('/donasi/status/{id}', [DashboardController::class, 'updateStatusDonasi'])->name('admin.donasi.status');
    Route::get('/donasi/detail/{id}', [DashboardController::class, 'showDonasiDetail'])->name('admin.donasi.detail');
    Route::get('/donasi/all', [DashboardController::class, 'allDonasi'])->name('admin.donasi.all');
    
    // Permintaan Management
    Route::post('/permintaan/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiPermintaan'])->name('admin.permintaan.verifikasi');
    Route::post('/permintaan/status/{id}', [DashboardController::class, 'updateStatusPermintaan'])->name('admin.permintaan.status');
    Route::get('/permintaan/detail/{id}', [DashboardController::class, 'showPermintaanDetail'])->name('admin.permintaan.detail');
    Route::get('/permintaan/all', [DashboardController::class, 'allPermintaan'])->name('admin.permintaan.all');
    
    // User Management
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'deletepengguna'])->name('admin.pengguna.delete');
    Route::get('/pengguna/all', [DashboardController::class, 'allpengguna'])->name('admin.pengguna.all');
    
    // Other pages
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('admin.riwayat');
    Route::get('/edukasi', [DashboardController::class, 'edukasi'])->name('admin.edukasi');
    Route::get('/faq', [DashboardController::class, 'faq'])->name('admin.faq');
});