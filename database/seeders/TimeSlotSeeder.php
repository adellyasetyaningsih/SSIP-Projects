<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    public function run()
    {
        TimeSlot::create([
            'time_slot_id' => 1,
            'category_id' => 'UTBK001', // Pastikan ada di tabel categories
            'date' => '2025-05-15',
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'subject_id' => 'PPU',       // Pastikan ada di tabel subjects
            'teacher_id' => 'T001',      // Pastikan ada di tabel teachers
            'classroom' => 'Ruang 101',
        ]);

        TimeSlot::create([
            'time_slot_id' => 2,
            'category_id' => 'SMA002',
            'date' => '2025-05-16',
            'start_time' => '10:30:00',
            'end_time' => '12:30:00',
            'subject_id' => 'Matematika',
            'teacher_id' => 'T002',
            'classroom' => 'Ruang 102',
        ]);
    }
}
