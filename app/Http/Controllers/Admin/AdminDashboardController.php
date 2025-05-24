<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    // Konstruktor untuk middleware yang memastikan hanya admin yang bisa mengakses
    public function __construct()
    {
        // Menggunakan middleware 'auth' untuk memastikan pengguna terautentikasi
        // dan 'is_admin' untuk memastikan hanya admin yang bisa mengakses halaman ini
        $this->middleware(['auth', 'is_admin']);
    }

    // Menampilkan dashboard admin
    public function index()
    {
        // Mengambil data untuk ditampilkan di dashboard admin
        return view('admin.dashboard');
    }

    // Menampilkan daftar siswa beserta kategori yang terkait
    public function showStudents()
    {
        // Ambil semua siswa beserta kategori terkait menggunakan eager loading
        $students = Student::with('category')->get();
        
        // Ambil semua pembayaran beserta siswa terkait menggunakan eager loading
        $payments = Payment::with('student')->get();

        // Kirim data siswa dan pembayaran ke tampilan
        return view('admin.student.index', compact('students', 'payments'));
    }



}