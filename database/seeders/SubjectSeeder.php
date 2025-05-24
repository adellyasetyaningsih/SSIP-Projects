<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create([
            'subject_id' => 'PPU',
            'category_id' => 'UTBK001',
            'file_path' => 'path/to/file.pdf',
            'title' => 'Matematika Dasar',
            'desc' => 'Materi dasar matematika untuk kelas awal',
        ]);

        // Contoh data lainnya
        Subject::create([
            'subject_id' => 'Fisika',
            'category_id' => 'SMA002',
            'file_path' => 'another/path/file.docx',
            'title' => 'Fisika Kelas 10',
            'desc' => 'Materi fisika untuk siswa kelas 10',
        ]);

        Subject::create([
            'subject_id' => 'Matematika',
            'category_id' => 'SMA002',
            'file_path' => 'another/path/file.docx',
            'title' => 'Matematika Kelas 10',
            'desc' => 'Materi fisika untuk siswa kelas 10',
        ]);

        // Tambahkan data subject lainnya sesuai kebutuhan Anda
    }
}