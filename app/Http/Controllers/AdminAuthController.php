<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // FORM LOGIN ADMIN
    public function showLoginForm()
    {
        // Mengembalikan view login admin (resources/views/auth/loginadmin.blade.php)
        return view('auth.loginadmin');
    }

    // PROSES LOGIN ADMIN
    public function login(Request $request)
    {
        // Ambil inputan dari form login admin
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari data admin berdasarkan email yang diinput
        $admin = Admin::where('admin_email', $email)->first();

        // Jika admin ditemukan dan password cocok dengan hash password di database
        if ($admin && Hash::check($password, $admin->admin_password)) {
            // Login admin menggunakan guard 'admin', dengan opsi remember jika diset
            Auth::guard('admin')->login($admin, $request->remember ?? false);
            // Regenerate session agar lebih aman (menghindari session fixation)
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Jika login gagal (email tidak ditemukan atau password salah), tampilkan pesan error
        return back()->withErrors([
            'login' => 'Email atau password admin salah.'
        ]);
    }

    // LOGOUT ADMIN
    public function logout(Request $request)
    {
        // Logout user dari guard admin
        Auth::guard('admin')->logout();
        // Invalidate session saat ini untuk mencegah session reuse
        $request->session()->invalidate();
        // Regenerate CSRF token untuk keamanan form di sesi berikutnya
        $request->session()->regenerateToken();

        return redirect()->route('login.admin');  // redirect ke halaman login admin
    }

}
