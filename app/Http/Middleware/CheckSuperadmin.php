<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSuperadmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'superadmin') {
            $bagian = session('bagian');

            if ($bagian) {
                return redirect()->route('dashboard', $bagian)
                    ->with('error', 'Akses ditolak: hanya superadmin yang dapat mengakses halaman ini.');
            }

            return redirect()->route('welcome')
                ->with('error', 'Akses ditolak: hanya superadmin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
