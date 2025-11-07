<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Donasi Routes (Public)
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/all', [DonasiController::class, 'index'])->name('donasi.index'); // semua donasi    
Route::get('/donasi/filter', [DonasiController::class, 'filter'])->name('donasi.filter');
Route::get('/donasi/create', [App\Http\Controllers\DonasiController::class, 'detail']); // <--- INI KEMUNGKINAN BESAR SUMBER MASALAH

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:pengguna')->group(function () {

    // Dashboard user
    Route::get('/home/dashboard', function () {
        return view('home.dashboard');
    })->name('home.dashboard');

    // Donasi create (pilih jenis)
    Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
    Route::post('donasi', [DonasiController::class, 'store'])->name('donasi.store'); // Simpan data

    // Form create donasi barang & uang
    Route::get('/donasi/barang/create', [DonasiController::class, 'createBarang'])->name('donasi.barang.create');
    Route::get('/donasi/uang/create', [DonasiController::class, 'createUang'])->name('donasi.uang.create');

    // Simpan donasi
    Route::post('/donasi/barang/store', [DonasiController::class, 'storeBarang'])->name('donasi.barang.store');
    Route::post('/donasi/uang/store', [DonasiController::class, 'storeUang'])->name('donasi.uang.store');

    // Upload bukti pengiriman (donasi barang)
    Route::get('/donasi/upload-bukti/{id}', [DonasiController::class, 'showUploadBukti'])->name('donasi.upload.form');
    Route::post('/donasi/upload-bukti/{id}', [DonasiController::class, 'uploadBukti'])->name('donasi.upload.store');

    // Riwayat donasi user
    Route::get('/donasi/riwayat', [DonasiController::class, 'riwayat'])->name('donasi.riwayat');

    // Request Donasi (User)
    Route::get('/donasi/request', [DonasiController::class, 'createRequest'])->name('donasi.request.create');
    Route::post('/donasi/request/store', [DonasiController::class, 'storeRequest'])->name('donasi.request.store');

    // Edit & Update request donasi
    Route::get('/donasi/request/edit/{id}', [DonasiController::class, 'editRequest'])->name('donasi.request.edit');
    Route::put('/donasi/request/update/{id}', [DonasiController::class, 'updateRequest'])->name('donasi.request.update');

    // Delete request donasi
    Route::delete('/donasi/request/delete/{id}', [DonasiController::class, 'deleteRequest'])->name('donasi.request.delete');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Statistic API
    Route::get('/statistics', [DashboardController::class, 'getStatistics'])->name('admin.statistics');

    // Donasi Management
    Route::post('/donasi/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiDonasi'])->name('admin.donasi.verifikasi');
    Route::post('/donasi/status/{id}', [DashboardController::class, 'updateStatusDonasi'])->name('admin.donasi.status');
    Route::get('/donasi/detail/{id}', [DashboardController::class, 'showDonasiDetail'])->name('admin.donasi.detail');
    Route::get('/donasi/all', [DashboardController::class, 'allDonasi'])->name('admin.donasi.all');

    // Halaman post donasi admin (drop-off manual)
    Route::get('/donasi', [DonasiController::class, 'PostDonasi'])->name('admin.donasi.PostDonasi');

    // Admin approve & delete request donasi
    Route::post('/donasi/approve/{id}', [DonasiController::class, 'approveRequest'])->name('admin.donasi.approve');
    Route::delete('/donasi/delete/{id}', [DonasiController::class, 'adminDeleteDonasi'])->name('admin.donasi.delete');

    // Permintaan Management
    Route::post('/permintaan/verifikasi/{id}', [DashboardController::class, 'updateVerifikasiPermintaan'])->name('admin.permintaan.verifikasi');
    Route::post('/permintaan/status/{id}', [DashboardController::class, 'updateStatusPermintaan'])->name('admin.permintaan.status');
    Route::get('/permintaan/detail/{id}', [DashboardController::class, 'showPermintaanDetail'])->name('admin.permintaan.detail');
    Route::get('/permintaan/all', [DashboardController::class, 'allPermintaan'])->name('admin.permintaan.all');

    // User Management
    Route::delete('/pengguna/delete/{id}', [DashboardController::class, 'deletePengguna'])->name('admin.pengguna.delete');
    Route::get('/pengguna/all', [DashboardController::class, 'allPengguna'])->name('admin.pengguna.all');

    // Other pages
    Route::get('/riwayat', [DashboardController::class, 'riwayat'])->name('admin.riwayat');
    Route::get('/edukasi', [DashboardController::class, 'edukasi'])->name('admin.edukasi');
    Route::get('/faq', [DashboardController::class, 'faq'])->name('admin.faq');

    // Route untuk menampilkan detail donasi (dipanggil oleh tombol 'Lihat Detail')
    Route::get('/admin/donasi/{id_donasi}', [DonasiController::class, 'show'])->name('admin.donasi.show');
    Route::post('/admin/donasi/update-status/{id}', [DonasiController::class, 'updateStatus'])->name('admin.donasi.update-status'); // <--- PASTIKAN NAMA INI SAMA

    // Route untuk memproses persetujuan atau penolakan
    Route::post('/admin/donasi/{id_donasi}/update-status', [DonasiController::class, 'updateStatus'])->name('admin.donasi.update-status');

    Route::get('/donasi/{id}', [DonasiController::class, 'showUserDetail'])->name('donasi.show');

    Route::delete('/admin/donasi/{id}', [DonasiController::class, 'destroy'])->name('admin.donasi.destroy');

    // Contoh: Controller yang benar mungkin adalah DashboardController
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::delete('/donasi/delete/{id}', [DonasiController::class, 'deleteDonasi'])->name('admin.donasi.delete');

    // 1. Route untuk Menghapus Donasi (Langsung)
    Route::delete('/donasi/{id}', [DonasiController::class, 'destroy'])->name('user.donasi.delete');

    // 2. Route untuk Menampilkan Form Edit
    Route::get('/donasi/{id}/edit', [DonasiController::class, 'edit'])->name('user.donasi.edit');

    // 3. Route untuk Mengajukan Permintaan Edit (Update ke status 'menunggu_edit')
    Route::put('/donasi/{id}', [DonasiController::class, 'requestEdit'])->name('user.donasi.requestEdit');

    Route::group(['prefix' => 'donasi', 'as' => 'donasi.', 'middleware' => 'auth'], function () {
    // Menampilkan form edit (GET /donasi/{id}/edit)
    Route::get('/{id}/edit', [DonasiController::class, 'edit'])->name('edit'); 
    
    // Menyimpan pengajuan perubahan (PUT/PATCH /donasi/{id})
    Route::put('/{id}', [DonasiController::class, 'requestUpdate'])->name('requestUpdate'); 

    Route::delete('/donasi/{id}', [DonasiController::class, 'destroy'])->name('admin.donasi.delete');
});
});
