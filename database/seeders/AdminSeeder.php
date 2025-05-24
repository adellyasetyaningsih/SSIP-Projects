<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Admin utama
        Admin::create([
            'admin_name' => 'Admin Utama',
            'admin_email' => 'admin@example.com',
            'admin_password' => Hash::make('password'),
        ]);

        // 3 admin tambahan
        Admin::create([
            'admin_name' => 'Admin 1',
            'admin_email' => 'admin1@example.com',
            'admin_password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'admin_name' => 'Admin 2',
            'admin_email' => 'admin2@example.com',
            'admin_password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'admin_name' => 'Admin 3',
            'admin_email' => 'admin3@example.com',
            'admin_password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'admin_name' => 'Admin 4',
            'admin_email' => 'admin4@example.com',
            'admin_password' => Hash::make('admin123'),
        ]);
    }
}