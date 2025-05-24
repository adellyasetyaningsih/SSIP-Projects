<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Menampilkan halaman materi untuk subject tertentu berdasarkan subject_id
     */
    public function show($subject_id)
    {
        // Ambil data student yang sedang login menggunakan guard 'web'
        $student = Auth::guard('web')->user(); // Gunakan guard student jika dibedakan

        // Ambil semua materi dengan subject_id sesuai parameter
        $subjects = Subject::where('subject_id', $subject_id)->get();

        // Jika tidak ada materi, redirect ke dashboard siswa dengan pesan error
        if ($subjects->isEmpty()) {
            return redirect()->route('student.dashboard')->with('error', 'Materi tidak ditemukan.');
        }

        // Ambil subject pertama sebagai subject utama (untuk judul dan validasi kategori)
        $mainSubject = $subjects->first();

        // Validasi: jika kategori siswa tidak cocok dengan kategori subject, tolak akses (403)
        if ($student->category_id !== $mainSubject->category_id) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk materi ini.');
        }

        // Ambil jadwal les (time slots) yang berhubungan dengan subject ini
        // Termasuk informasi guru (relasi 'teacher'), diurutkan berdasarkan tanggal dan jam mulai
        $timeSlots = TimeSlot::with('teacher')
            ->where('subject_id', $subject_id)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        // Kirim data materi, subject utama, dan jadwal ke view student.subject.show
        return view('student.subject.show', [
            'subjects' => $subjects,           // Daftar materi yang ditemukan
            'mainSubject' => $mainSubject,     // Subject utama untuk judul/validasi
            'timeSlots' => $timeSlots,         // Jadwal les yang berkaitan dengan subject
        ]);
    }
}
