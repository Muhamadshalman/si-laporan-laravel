<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/CheckRole.php

public function handle($request, Closure $next, ...$roles)
{
    $user = auth()->user();

    // Jika user admin → selalu boleh akses semua role
    if ($user->role === 'admin') {
        return $next($request);
    }

    // Jika bukan admin → cek apakah role cocok
    if (! in_array($user->role, $roles)) {
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    return $next($request);
}

}
