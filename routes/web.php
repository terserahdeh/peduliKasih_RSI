<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('register');
// });

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
<<<<<<< Updated upstream

// Auth routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

=======
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
// PERBAIKAN 1: Pastikan TipsnEdukasiController diimpor
use App\Http\Controllers\TipsnEdukasiController; 
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Public Pages & Front-End Routes (Tidak memerlukan login)
|--------------------------------------------------------------------------
*/

// 🏠 Halaman beranda utama. 
Route::get('/', [HomeController::class, 'index'])->name('home');

// 📰 Route untuk menampilkan halaman detail Tips & Edukasi tertentu
Route::get('/tips-edukasi/{id}', [HomeController::class, 'showTipsnEdukasi'])->name('home.showtipsnedukasi');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// [Tidak ada perubahan di sini]

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
>>>>>>> Stashed changes
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:pengguna')->get('/pengguna/dashboard', function () {
    return view('pengguna.dashboard');
})->name('pengguna.dashboard');

<<<<<<< Updated upstream
Route::middleware('auth:admin')->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
=======
/*
|--------------------------------------------------------------------------
| User Dashboard Routes (Pengguna Terotentikasi)
|--------------------------------------------------------------------------
*/
// [Tidak ada perubahan di sini]

    Route::middleware(['auth:pengguna'])->group(function () {
    Route::get('/home/dashboard', [HomeController::class, 'index'])->name('home.dashboard'); 
    //👤 Profile Management
    Route::prefix('home')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('home.profile.show'); 
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('home.profile.edit'); 
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('home.profile.update');
});
});


/*
|--------------------------------------------------------------------------
| Admin Routes (Prefix: /admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

// 👑 Dashboard Utama Admin
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/statistics', [DashboardController::class, 'getStatistics'])->name('admin.statistics');

    // 💡 Tips & Edukasi Management 
    // Rute resource ini menciptakan rute bernama: admin.tips.index, admin.tips.create, dll.
Route::resource('/edukasintips', TipsnEdukasiController::class)->names('admin.edukasintips');

Route::get('/faq', [DashboardController::class, 'faq'])->name('admin.faq');
// --- Donasi Management --- 
Route::post('/donasi/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiDonasi'])->name('admin.donasi.verifikasi');
Route::post('/donasi/status/{id}', [DashboardController::class, 'updateStatusDonasi'])->name('admin.donasi.status');
Route::get('/donasi/detail/{id}', [DashboardController::class, 'showDonasiDetail'])->name('admin.donasi.detail');
Route::get('/donasi/all', [DashboardController::class, 'allDonasi'])->name('admin.donasi.all');
// --- Permintaan Bantuan Management ---
Route::post('/permintaan/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiPermintaan'])->name('admin.permintaan.verifikasi');
Route::post('/permintaan/status/{id}', [DashboardController::class, 'updateStatusPermintaan'])->name('admin.permintaan.status');
Route::get('/permintaan/detail/{id}', [DashboardController::class, 'showPermintaanDetail'])->name('admin.permintaan.detail');
Route::get('/permintaan/all', [DashboardController::class, 'allPermintaan'])->name('admin.permintaan.all');
// --- Pengguna Management ---
Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'deletePengguna'])->name('admin.pengguna.delete');
Route::get('/pengguna/all', [DashboardController::class, 'allPengguna'])->name('admin.pengguna.all');
// --- Halaman Administrasi Lainnya ---
Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('admin.riwayat');
});
>>>>>>> Stashed changes
