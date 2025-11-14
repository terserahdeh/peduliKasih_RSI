<?php

use Illuminate\Support\Facades\Route;
// Import Controllers yang digunakan (Pastikan ini sudah benar)
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TipsnEdukasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\UpvoteController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage/Beranda (Publik)
// Route::get('/', function () { return view('welcome'); }); // Dihapus, menggunakan Controller
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tips & Edukasi Public Detail
Route::get('/home/tipsnedukasi/{id}', [HomeController::class, 'showTipsnEdukasi'])->name('home.showtipsnedukasi');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Donasi Routes (Public)
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/all', [DonasiController::class, 'index'])->name('donasi.all');
Route::get('/donasi/filter', [DonasiController::class, 'filter'])->name('donasi.filter');
// Perbaikan: Rute Donasi Detail (Publik)
Route::get('/donasi/{id}', [DonasiController::class, 'show'])->name('donasi.show'); 

Route::get('/donasi/create', [DonasiController::class, 'index'])->name('donasi.create');

// Tampilan FAQ User (Publik - Untuk section di beranda)
Route::get('/faq', [FaqController::class, 'showUserFaq'])->name('faq.user.index');

Route::get('/donasi/{id}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
Route::delete('/donasi/{id}', [DonasiController::class, 'destroy'])->name('donasi.destroy');





/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Middleware: auth:pengguna)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:pengguna'])->group(function () {
    // Dashboard User
    Route::get('/home/dashboard', [HomeController::class, 'index'])->name('home.dashboard');

    // Profile User
    Route::get('/home/profile', [ProfileController::class, 'show'])->name('home.show'); 
    Route::get('/home/edit', [ProfileController::class, 'edit'])->name('home.edit'); 
    Route::post('/home/update', [ProfileController::class, 'update'])->name('home.update');
 
    // Group Request Donasi
    Route::prefix('request-donasi')->name('request-donasi.')->group(function () {
        Route::get('/', [RequestController::class, 'landing'])->name('landing');
        Route::get('/daftar', [RequestController::class, 'index'])->name('index');
        Route::get('/create', [RequestController::class, 'create'])->name('create');
        Route::post('/', [RequestController::class, 'store'])->name('store');
        Route::get('/status', [RequestController::class, 'status'])->name('status');
        Route::get('/{id_request}', [RequestController::class, 'show'])->name('show');
        Route::get('/{id_request}/edit', [RequestController::class, 'edit'])->name('edit');
        Route::put('/{id_request}', [RequestController::class, 'update'])->name('update');
        Route::delete('/{id_request}', [RequestController::class, 'destroy'])->name('destroy');

        //upvote
        Route::post('/{id_request}/upvote', [UpvoteController::class, 'toggle'])->name('upvote');
    });

    // Group Donasi (Transaksi)
    Route::prefix('donasi')->name('donasi.')->group(function () {
        Route::get('/create', [DonasiController::class, 'create'])->name('create');
        Route::post('/', [DonasiController::class, 'store'])->name('store');
        Route::get('/barang/create', [DonasiController::class, 'createBarang'])->name('barang.create');
        Route::get('/uang/create', [DonasiController::class, 'createUang'])->name('uang.create');
        Route::post('/barang/store', [DonasiController::class, 'storeBarang'])->name('barang.store');
        Route::post('/uang/store', [DonasiController::class, 'storeUang'])->name('uang.store');
        Route::get('/upload-bukti/{id}', [DonasiController::class, 'showUploadBukti'])->name('upload.form');
        Route::post('/upload-bukti/{id}', [DonasiController::class, 'uploadBukti'])->name('upload.store');
        Route::get('/riwayat', [DonasiController::class, 'riwayat'])->name('riwayat');

        // Request Donasi (User)
        Route::get('/request', [DonasiController::class, 'createRequest'])->name('request.create');
        Route::post('/request/store', [DonasiController::class, 'storeRequest'])->name('request.store');
        Route::get('/request/edit/{id}', [DonasiController::class, 'editRequest'])->name('request.edit');
        Route::put('/request/update/{id}', [DonasiController::class, 'updateRequest'])->name('request.update');
        Route::delete('/request/delete/{id}', [DonasiController::class, 'deleteRequest'])->name('request.delete');
        
        // Rute Edit/Hapus Donasi User
        // Rute Edit/Hapus Donasi User (sudah diperbaiki)
        Route::get('/{id}/edit', [DonasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DonasiController::class, 'requestUpdate'])->name('update');
        Route::delete('/{id}', [DonasiController::class, 'destroy'])->name('destroy');

    });
});


/*
|--------------------------------------------------------------------------
| Admin Routes (Middleware: auth:admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [DashboardController::class, 'getStatistics'])->name('statistics');
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');

    // Donasi Management (Detail/Status)
    Route::get('/donasi/all', [DashboardController::class, 'allDonasi'])->name('donasi.all');
    Route::get('/donasi/detail/{id}', [DashboardController::class, 'showDonasiDetail'])->name('donasi.detail');
    Route::post('/donasi/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiDonasi'])->name('donasi.verifikasi');
    Route::post('/donasi/status/{id}', [DashboardController::class, 'updateStatusDonasi'])->name('donasi.status');
    Route::post('/donasi/approve/{id}', [DonasiController::class, 'approveRequest'])->name('donasi.approve');
    Route::delete('/donasi/delete/{id}', [DonasiController::class, 'DeleteDonasi'])->name('donasi.delete'); // Admin delete donasi
    
    // Admin Post Donasi (Drop-off manual)
    Route::get('/donasi', [DonasiController::class, 'PostDonasi'])->name('donasi.PostDonasi'); 

    // Permintaan Management
    Route::get('/permintaan/all', [DashboardController::class, 'allPermintaan'])->name('permintaan.all');
    Route::get('/permintaan/detail/{id}', [DashboardController::class, 'show'])->name('permintaan.detail');
    Route::post('/permintaan/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiPermintaan'])->name('permintaan.verifikasi');
    Route::post('/permintaan/status/{id}', [DashboardController::class, 'updateStatusPermintaan'])->name('permintaan.status');

    // User Management
    Route::get('/pengguna/all', [DashboardController::class, 'allPengguna'])->name('pengguna.all');
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'deletePengguna'])->name('pengguna.delete');

    // Tips & Edukasi Management
    Route::get('/edukasi', [TipsnEdukasiController::class, 'index'])->name('edukasintips');
    Route::get('/edukasi/{edukasintip}/edit', [TipsnEdukasiController::class, 'edit'])->name('edukasintips.edit');
    Route::post('/edukasi/{edukasintip}', [TipsnEdukasiController::class, 'update'])->name('edukasintips.update');

    /*
    |--------------------------------------------------------------------------
    | ✅ PERBAIKAN: FAQ Admin CRUD (AdminFaqController)
    |--------------------------------------------------------------------------
    */
    // Menggantikan Route::get('/faq', [DashboardController::class, 'faq']) yang error
    Route::resource('faq', AdminFaqController::class); // <-- HANYA INI
    
    // Route khusus untuk toggle is_active (Perlu disesuaikan)
    Route::get('faq/{faq}/toggle', [AdminFaqController::class, 'toggleActive'])->name('faq.toggle');
    Route::post('/donasi/process-edit/{id}', [DonasiController::class, 'processEditRequest'])->name('donasi.processEdit');
    Route::post('/admin/donasi/process-edit/{id}', [DashboardController::class, 'processEditDonasi']);

    /*
    |--------------------------------------------------------------------------
    | Rute yang tidak terpakai/duplikat Dihapus dari bawah
    |--------------------------------------------------------------------------
    */
});