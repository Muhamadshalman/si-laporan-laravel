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

        Session::put('role', $role);
        Session::put('logged_in', true);

        // Jika superadmin
        if ($role === 'superadmin') {
            // Tidak perlu bagian, langsung ke halaman superadmin
            return redirect('/dashboard/superadmin');
        }

        // Untuk user biasa harus sesuai bagian
        $bagian = $request->bagian;

        if ($role === $bagian) {
            Session::put('bagian', $bagian);
            return redirect("/dashboard/{$bagian}");
        }

        return back()->with('error', 'Akses ditolak ke bagian tersebut.');
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
