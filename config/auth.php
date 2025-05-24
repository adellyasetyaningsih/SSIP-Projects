<?php

return [
    'defaults' => [
        'guard' => 'web',  // Guard default adalah 'web' untuk siswa
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'students',  // Gunakan provider 'students' untuk siswa
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',  // Gunakan provider 'admins' untuk admin
        ],
    ],

    // Provider adalah sumber data user yang digunakan guard untuk autentikasi
    'providers' => [
        // Provider default 'users' (bisa untuk user umum jika ada)
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Model User jika ada
        ],

        // Provider untuk admin, menggunakan model Admin
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,  // Model untuk admin
        ],

        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,  // Model untuk siswa
        ],
    ],

    // Konfigurasi reset password untuk tiap provider
    'passwords' => [
        // Reset password untuk users (default)
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens', // Tabel untuk menyimpan token reset password
            'expire' => 60, // Token expired dalam 60 menit
            'throttle' => 60,  // Delay minimal 60 detik sebelum request reset berikutnya
        ],

        // Reset password untuk admin
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Reset password untuk siswa/student
        'students' => [
            'provider' => 'students',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    // Waktu timeout setelah password harus dimasukkan ulang (detik)
    'password_timeout' => 10800,
];
