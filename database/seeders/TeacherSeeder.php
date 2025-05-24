<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    // database/seeders/TeacherSeeder.php

public function run()
{
    Teacher::create([
        'teacher_id' => 'T001',
        'teacher_f_name' => 'Budi',
        'teacher_l_name' => 'Santoso',
    ]);

    Teacher::create([
        'teacher_id' => 'T002', // Pastikan ini ada
        'teacher_f_name' => 'Siti',
        'teacher_l_name' => 'Aminah',
    ]);
}
}