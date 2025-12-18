<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\CheckBagian;

// ===============================
// 🔹 HALAMAN PUBLIK
// ===============================
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

Route::get('/tentang', function () {
    return view('pages.tentang');
})->name('tentang');

Route::get('/informasi', function () {
    return view('pages.informasi');
})->name('informasi');


// ======================================
// 🔹 LOGIN & LOGOUT
// ======================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ======================================
// 🔹 SUPERADMIN DASHBOARD KHUSUS
// ======================================
Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->name('superadmin.dashboard');  // ← Tambah DI SINI!

// ======================================
// 🔹 SUPERADMIN AKSES SEMUA BAGIAN
// ======================================
Route::get('/dashboard/{bagian}', [LaporanController::class, 'index'])
    ->whereIn('bagian', ['umum', 'keuangan', 'persidangan', 'fasilitasi'])
    ->name('dashboard'); // ← WAJIB ADA!


/*
|--------------------------------------------------------------------------
| 🔹 ROUTE KHUSUS USER BAGIAN (dibatasi middleware)
|--------------------------------------------------------------------------
| User biasa hanya bisa akses sesuai bagian yang ada di session.
*/
Route::middleware([CheckBagian::class])->group(function () {

    // Upload laporan
    Route::post('/dashboard/{bagian}/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

});


// ======================================
// 🔹 HAPUS LAPORAN (superadmin & pemilik)
// ======================================
Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])
    ->name('laporan.destroy');


// ======================================
// 🔹 DOWNLOAD FILE (semua yang login boleh)
// ======================================
Route::get('/download/{type}/{filename}', [LaporanController::class, 'download'])
    ->name('laporan.download');
