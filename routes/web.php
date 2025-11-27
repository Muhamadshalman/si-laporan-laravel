<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\FasilitasiController;
use App\Http\Controllers\PersidanganController;

// ==============================
// 🔹 HALAMAN PEMBUKA (Sebelum Login)
// ==============================
Route::get('/', function () {
    return view('auth.welcome'); // <-- halaman pilihan bagian
})->name('welcome');

// ==============================
// 🔹 HALAMAN LOGIN
// ==============================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ==============================
// 🔹 DASHBOARD SETIAP BAGIAN
// ==============================
Route::get('/dashboard/umum', [UmumController::class, 'index'])->name('dashboard.umum');
Route::get('/dashboard/keuangan', [KeuanganController::class, 'index'])->name('dashboard.keuangan');
Route::get('/dashboard/fasilitasi', [FasilitasiController::class, 'index'])->name('dashboard.fasilitasi');
Route::get('/dashboard/persidangan', [PersidanganController::class, 'index'])->name('dashboard.persidangan');
// ==============================
// 🔹 LOGOUT
// ==============================
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

