<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/

// Halaman beranda utama (home)
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
| Dashboard Pengguna (User)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\ProfileController;

Route::middleware(['auth:pengguna'])->group(function () {
    // Dashboard
    // Route::get('/home/dashboard', function () {
    //     return view('home.dashboard');
    // })->name('home.dashboard');
    Route::get('/home/dashboard', [HomeController::class, 'index'])->name('home.dashboard');


    // Profile
    Route::get('/home/profile', [ProfileController::class, 'show'])->name('home.show'); 
    Route::get('/home/edit', [ProfileController::class, 'edit'])->name('home.edit'); 
    Route::post('/home/update', [ProfileController::class, 'update'])->name('home.update');
});



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Statistics API
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
    
    // Show table
    Route::get('/dashboard/donasi-table', [DashboardController::class, 'donasiTable'])->name('donasi.table');
    Route::get('/dashboard/permintaan-table', [DashboardController::class, 'permintaanTable'])->name('permintaan.table');

    // User Management
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'deletePengguna'])->name('admin.pengguna.delete');
    Route::get('/pengguna/all', [DashboardController::class, 'allPengguna'])->name('admin.pengguna.all');
    
    // Other pages
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('admin.riwayat');
    Route::get('/edukasi', [DashboardController::class, 'edukasi'])->name('admin.edukasi');
    Route::get('/faq', [DashboardController::class, 'faq'])->name('admin.faq');
});
