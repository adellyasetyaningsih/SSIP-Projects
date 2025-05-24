<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // FORM LOGIN STUDENT
    public function showStudentLoginForm()
    {
        // Menampilkan halaman view login siswa (resources/views/auth/login.blade.php)
        return view('auth.login');
    }

    // PROSES LOGIN STUDENT
    public function login(Request $request)
    {
        // Ambil data input email dan password dari form login
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari data siswa berdasarkan email yang diinput
        $student = Student::where('email', $email)->first();

        // Jika siswa ditemukan dan password yang diinput sesuai dengan hash password di DB
        if ($student && Hash::check($password, $student->password)) {
            // Cek apakah siswa sudah punya pembayaran dengan status 'confirmed'
            if ($student->payments()->where('pay_status', 'confirmed')->exists()) {
                // Login siswa menggunakan guard 'web' dan opsi remember sesuai input user
                Auth::guard('web')->login($student, $request->remember ?? false);

                // Regenerate session untuk keamanan (menghindari session fixation)
                $request->session()->regenerate();
                // Redirect siswa ke dashboard setelah login sukses
                return redirect()->route('student.dashboard');
            }

            // Jika pembayaran belum dikonfirmasi, kembalikan ke form login dengan error pesan verifikasi pembayaran
            return back()->withErrors([
                'email' => 'Akun Anda belum diverifikasi pembayarannya.'
            ])->onlyInput('email');
        }

        // Jika email atau password salah, kembalikan ke form login dengan error validasi
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');
    }

    // FORM REGISTER STUDENT
    public function showStudentRegistrationForm()
    {
        $categories = Category::all();
        // Tampilkan halaman form registrasi siswa dan passing data kategori ke view
        return view('auth.register-student', compact('categories'));
    }

    // PROSES REGISTER STUDENT
    public function registerStudent(Request $request)
    {
        // Buat validasi input form pendaftaran siswa menggunakan Validator Laravel
        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'nullable|string|max:255',
            'dob'          => 'required|date',
            'phone'        => 'required|string|max:20|unique:students,phone_num',
            'email'        => 'required|string|email|max:255|unique:students,email',
            'password'     => 'required|string|min:8|confirmed',
            'category_id'  => 'required|string|exists:categories,category_id',
        ]);

        // Jika validasi gagal, redirect balik ke form dengan error dan input lama tetap diisi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil data kategori berdasarkan category_id yang dipilih user
        $category = Category::where('category_id', $request->category_id)->first();
        // Hitung jumlah siswa yang sudah terdaftar di kategori tersebut
        $registeredCount = Student::where('category_id', $category->category_id)->count();

        // Jika jumlah pendaftar sudah melebihi atau sama dengan kuota kategori, tampilkan error kuota penuh
        if ($registeredCount >= $category->quota) {
            return redirect()->back()->withErrors([
                'category_id' => 'Kuota untuk paket ini sudah penuh.'
            ])->withInput();
        }

        // Buat nomor urut 3 digit untuk student id, dengan padding nol di depan jika kurang dari 3 digit
        $sequence = str_pad($registeredCount + 1, 3, '0', STR_PAD_LEFT);
        // Bentuk student ID: gabungan category_id (lowercase) + nomor urut 3 digit, misal 'utbk001'
        $studentId = strtolower($category->category_id) . $sequence;

        try {
            // Simpan data siswa baru ke tabel students
            $student = Student::create([
                'student_id' => $studentId,
                'f_name' => $request->first_name,
                'l_name' => $request->last_name,
                'd_birth' => $request->dob,
                'phone_num' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'category_id' => $category->category_id,
            ]);

            Payment::create([
                'student_id' => $student->student_id,
                'pay_status' => 'pending',
            ]);

            $adminPhone = '6281319201773'; // Ganti nomor admin
            $message = "Halo admin, saya baru saja mendaftar di P3K.\n\n" .
                       "Nama: {$student->f_name} {$student->l_name}\n" .
                       "Email: {$student->email}\n" .
                       "Kategori: {$category->name}\n" .
                       "Student ID: {$student->student_id}\n\n" .
                       "Mohon verifikasi pembayaran saya ya 🙏";

            $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);
            // Redirect user ke WhatsApp untuk mengirim pesan ke admin
            return redirect()->away($waUrl);
        } catch (\Exception $e) {
             // Jika terjadi error saat simpan data, redirect balik dengan pesan error
            return redirect()->back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->withInput();
        }
    }

    // LOGOUT STUDENT
    public function logout(Request $request)
    {
        // Logout user dari guard web (student)
        Auth::guard('web')->logout();
         // Hapus session lama dan buat session baru untuk mencegah sesi reuse
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect user ke halaman home setelah logout
        return redirect('/home');
    }
}
