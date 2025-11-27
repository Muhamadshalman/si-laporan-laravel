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

        // Admin
        'admin' => ['email' => 'admin@example.com', 'password' => 'admin123']
    ];

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
            'bagian'    => 'required',
        ]);

        $bagianDipilih = $request->bagian;

        // Cek satu per satu akun
        foreach ($this->accounts as $role => $akun) {
            if ($request->email === $akun['email'] && $request->password === $akun['password']) {

                // Simpan role sebenarnya
                Session::put('role', $role);

                // Simpan bagian yang dipilih user
                Session::put('bagian', $bagianDipilih);

                // Admin bebas memilih bagian mana saja
                if ($role === 'admin') {
                    Session::put('logged_in', true);
                    return redirect("/dashboard/{$bagianDipilih}");
                }

                // User biasa: hanya bisa login ke bagiannya sendiri
                if ($role === $bagianDipilih) {
                    Session::put('logged_in', true);
                    return redirect("/dashboard/{$bagianDipilih}");
                }

                // Jika user biasa memilih bagian lain
                return back()->with('error', 'Anda tidak punya akses ke bagian tersebut.');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
