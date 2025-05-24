<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_id' => 'UTBK001',
                'price' => 150000.00,
                'quota' => 10, // Quota diubah menjadi integer
            ],
            [
                'category_id' => 'SMA002',
                'price' => 100000.00,
                'quota' => 10, // Quota diubah menjadi integer
            ],
            [
                'category_id' => 'SEKDIN003',
                'price' => 120000.00,
                'quota' => 10, // Quota diubah menjadi integer
            ],
        ]);
    }
}