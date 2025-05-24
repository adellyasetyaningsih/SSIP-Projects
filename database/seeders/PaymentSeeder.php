<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            ['pay_status' => 'pending', 'student_id' => 'S001001'],
            ['pay_status' => 'confirmed', 'student_id' => 'S001002'],
            ['pay_status' => 'rejected', 'student_id' => 'S001003'],
            ['pay_status' => 'pending', 'student_id' => 'S001004'],
            ['pay_status' => 'confirmed', 'student_id' => 'S001005'],
        ];

        DB::table('payments')->insert($payments);
    }
}