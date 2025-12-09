<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Middleware\CheckBagian;

// ==============================
// 🔹 HALAMAN PEMBUKA (Sebelum Login)
// ==============================
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');


// ==============================
// 🔹 SUPERADMIN (BISA AKSES SEMUA BAGIAN)
// ==============================
Route::get('/dashboard/superadmin', function () {
    if (!session('logged_in') || session('role') !== 'superadmin') {
        abort(403);
    }
    return view('superadmin.dashboard');
})->name('superadmin.dashboard');


// ==============================
// 🔹 LOGIN & LOGOUT
// ==============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================================
// 🔹 DASHBOARD PER BAGIAN
// 🔹 Superadmin dapat mengakses SEMUA bagian TANPA dicegah middleware
// 🔹 User bagian biasa tetap dibatasi menggunakan CheckBagian
// ====================================================================
Route::middleware([CheckBagian::class])->group(function () {

    // List dashboard per bagian
    Route::get('/dashboard/{bagian}', [LaporanController::class, 'index'])
        ->name('dashboard');

    // Upload laporan
    Route::post('/dashboard/{bagian}/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');
});

// ==============================
// 🔹 HAPUS LAPORAN (TIDAK BOLEH PAKAI CHECKBAGIAN)
// ==============================
    Route::delete('/laporan/{id}/hapus', [LaporanController::class, 'destroy'])
    ->name('laporan.destroy');

// ==============================
// 🔹 DOWNLOAD FILE
// ==============================
    Route::get('/download/{type}/{filename}', [LaporanController::class, 'download'])
    ->name('laporan.download');


// ==============================
// 🔹 DOWNLOAD FILE (boleh semua yang login)
// ==============================
Route::get('/download/{type}/{filename}', [LaporanController::class, 'download'])
    ->name('laporan.download');
