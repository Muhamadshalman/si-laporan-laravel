<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

// ==============================
// 🔹 HALAMAN PEMBUKA (Sebelum Login)
// ==============================
Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

// Superadmin

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

// ==============================
// 🔹 DASHBOARD PER BAGIAN (DATA TERPISAH)
// ==============================
// Semua route ini hanya bisa diakses setelah login (via session)
Route::middleware([\App\Http\Middleware\CheckBagian::class])->group(function () {
    Route::get('/dashboard/{bagian}', [LaporanController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/{bagian}/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});

// ==============================
// 🔹 DOWNLOAD FILE (boleh diakses semua bagian yang login)
// ==============================
Route::get('/download/{type}/{filename}', [LaporanController::class, 'download'])->name('laporan.download');