<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // Cek apakah permintaan bukan dari aplikasi berbasis JSON (misalnya API)
        if (!$request->expectsJson()) {
            // Jika URL yang diakses dimulai dengan "admin" atau "admin/*"
            if ($request->is('admin') || $request->is('admin/*')) {
                // Maka redirect ke route khusus login admin
                return route('login.admin');
            }
            // Jika bukan akses admin, arahkan ke login student (default)
            return route('login.student');
        }
    }


}
