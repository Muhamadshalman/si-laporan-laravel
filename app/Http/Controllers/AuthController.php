<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $accounts = [
        'umum' => ['email' => 'umum@example.com', 'password' => '12345'],
        'keuangan' => ['email' => 'keuangan@example.com', 'password' => '12345'],
        'fasilitasi' => ['email' => 'fasilitasi@example.com', 'password' => '12345'],
        'persidangan' => ['email' => 'persidangan@example.com', 'password' => '12345'],
        'admin' => ['email' => 'admin@example.com', 'password' => 'admin123'],
        'superadmin' => [
        'email' => 'superadmin@dprd.sukabumi.go.id',
        'password' => 'sukabumikuselamanya'
    ]
    ];

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
        'bagian' => 'required_unless:email,superadmin@dprd.sukabumi.go.id',
    ]);

    foreach ($this->accounts as $role => $akun) {

        if ($request->email === $akun['email'] && $request->password === $akun['password']) {

            // Wajib: simpan session login & role
            session([
                'logged_in' => true,
                'role' => $role,
            ]);

            // ==============================
            // 🟥 1. LOGIN SUPERADMIN
            // ==============================
            if ($role === 'superadmin') {

                // Simpan sebagai superadmin
                session(['bagian' => 'superadmin']); // WAJIB agar middleware tidak error

                return redirect()->route('superadmin.dashboard');
            }

            // ==============================
            // 🟦 2. LOGIN USER BAGIAN
            // ==============================
            $bagian = $request->bagian;

            if ($role === $bagian) {
                session(['bagian' => $bagian]);
                return redirect("/dashboard/{$bagian}");
            }

            return back()->with('error', 'Akses ditolak ke bagian tersebut.');
        }
    }

    return back()->with('error', 'Email atau password salah!');
}
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('welcome');
    }
}
