<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckBagian
{
    public function handle(Request $request, Closure $next)
{
    if (!Session::get('logged_in')) {
        return redirect('/login');
    }

    // 🔥 Super admin boleh akses SEMUA bagian
    if (Session::get('role') === 'superadmin') {
        return $next($request);
    }

    // User biasa: sesuai bagian
    $bagianIzin = Session::get('bagian');
    $bagianUrl = $request->route('bagian');

    if ($bagianUrl !== $bagianIzin) {
        abort(403, 'Akses ditolak.');
    }

    return $next($request);
}
}