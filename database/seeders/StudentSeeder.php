<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['student_id' => 'S001001', 'f_name' => 'Dellya', 'l_name' => 'Putri', 'd_birth' => '2006-08-14', 'phone_num' => '081234567890', 'email' => 'dellya@example.com', 'password' => Hash::make('password')],
            ['student_id' => 'S001002', 'f_name' => 'Andi', 'l_name' => 'Wijaya', 'd_birth' => '2005-11-20', 'phone_num' => '081122334455', 'email' => 'andi@example.com', 'password' => Hash::make('password')],
            ['student_id' => 'S001003', 'f_name' => 'Siti', 'l_name' => 'Rahayu', 'd_birth' => '2007-03-01', 'phone_num' => '081356789012', 'email' => 'siti@example.com', 'password' => Hash::make('password')],
            ['student_id' => 'S001004', 'f_name' => 'Budi', 'l_name' => 'Setiawan', 'd_birth' => '2004-09-25', 'phone_num' => '081987654321', 'email' => 'budi@example.com', 'password' => Hash::make('password')],
            ['student_id' => 'S001005', 'f_name' => 'Aisyah', 'l_name' => 'Dewi', 'd_birth' => '2008-01-10', 'phone_num' => '081512345678', 'email' => 'aisyah@example.com', 'password' => Hash::make('password')],
        ];

        DB::table('students')->insert($students);
    }
}