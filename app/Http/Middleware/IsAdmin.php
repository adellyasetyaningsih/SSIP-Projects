<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna login dengan guard admin
        if (Auth::guard('admin')->check()) {
            // Jika iya, lanjutkan ke proses berikutnya (akses diperbolehkan)
            return $next($request);
        }

        // Kalau tidak, redirect ke halaman login admin (atau halaman utama)
        return redirect()->route('login')->withErrors([
            'login' => 'Akses ditolak. Kamu bukan admin.',
        ]);
    }
}
