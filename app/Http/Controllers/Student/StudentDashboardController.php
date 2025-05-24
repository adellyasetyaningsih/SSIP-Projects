<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function __construct()
    {
        // Middleware auth: hanya user yang login yang bisa mengakses controller ini
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Mengambil data user yang sedang login (diasumsikan student)
        $student = auth()->user();
        
        // Jika tidak ditemukan student (tidak login), arahkan ke halaman login
        if (!$student) {
            return redirect()->route('login');
        }

        // Ambil ID kategori dari student
        $categoryId = $student->category_id;

        // Jika student belum memiliki kategori, arahkan ke home dengan pesan error
        if (!$categoryId) {
            return redirect()->route('home')->with('error', 'Category not assigned to the student.');
        }

        // Mapping category_id ke nama kategori agar bisa ditampilkan di dashboard
        $categoryNames = [
            'UTBK001' => 'UTBK',
            'SMA002' => 'SMA',
            'SEKDIN003' => 'SEKDIN',
        ];

        // Ambil nama kategori dari mapping berdasarkan ID yang dimiliki student
        $categoryName = $categoryNames[$categoryId] ?? 'Unknown Category';

        // Ambil data timeSlot sesuai kategori student, termasuk relasi subject & teacher
        $timeSlots = TimeSlot::with(['subject', 'teacher'])
            ->where('category_id', $categoryId)      // filter berdasarkan kategori student
            ->orderBy('date')                        // urutkan berdasarkan tanggal
            ->orderBy('start_time')                  // lalu berdasarkan jam mulai
            ->get();  

        // Kelompokkan jadwal berdasarkan subject_id    
        $groupedBySubject = $timeSlots->groupBy('subject_id');

        // Dari tiap group subject, ambil subject dan nama guru dari salah satu timeSlot
        $subjects = $groupedBySubject->map(function ($group) {
            $firstTimeSlot = $group->first();          // ambil satu slot pertama dari tiap subject
            $subject = $firstTimeSlot->subject;        // ambil relasi subject
            $teacher = $firstTimeSlot->teacher;        // ambil relasi teacher

            return (object)[
                'subject_id' => $subject->subject_id,
                'teacher_name' => $teacher ? $teacher->teacher_f_name . ' ' . $teacher->teacher_l_name : 'Guru tidak tersedia',
            ];
        })->values();   // reset indeks agar array-nya bersih dari key subject_id

        // Kirim data ke view student.dashboard
        return view('student.dashboard', [
            'category' => $categoryName,
            'subjects' => $subjects,
            'timeSlots' => $timeSlots,
        ]);
    }
}
