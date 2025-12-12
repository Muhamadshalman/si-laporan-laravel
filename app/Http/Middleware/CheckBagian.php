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
    // Superadmin boleh akses semua
    if (session('role') === 'superadmin') {
        return $next($request);
    }

    // Bagian dari URL → /dashboard/{bagian}
    $bagian = $request->route('bagian');

    // Cocokkan dengan session('bagian'), bukan role
    if (session('bagian') !== $bagian) {
        abort(403, 'Anda tidak memiliki akses ke bagian ini.');
    }

    return $next($request);
}
}