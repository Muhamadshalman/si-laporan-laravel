<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckBagian
{
    // app/Http/Middleware/CheckBagian.php

public function handle($request, Closure $next)
{
    // Jika superadmin → bebas akses semua
    if (session('role') === 'superadmin') {
        return $next($request);
    }

    // Jika bukan superadmin → harus cocok dengan bagian
    $bagian = $request->route('bagian');

    if (session('role') !== $bagian) {
        abort(403, 'Anda tidak memiliki akses ke bagian ini.');
    }

    return $next($request);
}
}