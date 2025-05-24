<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
{
    $this->call([
        CategorySeeder::class,
        StudentSeeder::class,
        TeacherSeeder::class,
        SubjectSeeder::class,
        TimeSlotSeeder::class,
        PaymentSeeder::class,
        AdminSeeder::class,
    ]);
}

    
}
