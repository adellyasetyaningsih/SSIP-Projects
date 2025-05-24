<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student; // Model Student untuk akses data mahasiswa
use App\Models\Payment;
use App\Models\Category; // Model Category untuk akses data kategori
use Illuminate\Http\Request; // Request digunakan untuk menangani input dari form

class StudentDataController extends Controller
{
    // Tampilkan daftar semua siswa dan pembayaran
    public function index()
    {
        $students = Student::all(); // Ambil semua data student dari database
        $payments = Payment::all();

        // Kirim data ke view index
        return view('admin.student.index', compact('students', 'payments'));
    }

    // Tampilkan form edit student
    public function edit($id)
    {
        $student = Student::findOrFail($id); // Cari student berdasarkan ID, jika tidak ditemukan akan gagal
        $categories = Category::all(); // Ambil semua kategori untuk dropdown pada form edit
        return view('admin.student.edit', compact('student', 'categories')); // Kirim data student & category ke view
    }

     // Fungsi untuk memproses update data student
   public function update(Request $request, $student_id)
{
    // Validasi input dari form
    $validated = $request->validate([
        'f_name' => 'required|string|max:255',
        'l_name' => 'required|string|max:255',
        'd_birth' => 'required|date',
        'phone_num' => 'required|string|max:20',
        'email' => 'required|email',
        'category_id' => 'required|exists:categories,category_id',
        'password' => 'nullable|string|min:6|confirmed', // Password opsional, minimal 6 karakter, harus sama dengan konfirmasi
    ]);

    $student = Student::findOrFail($student_id); // Cari student berdasarkan ID, jika tidak ada tampilkan error

    // Update data student dari hasil validasi
    $student->f_name = $validated['f_name'];
    $student->l_name = $validated['l_name'];
    $student->d_birth = $validated['d_birth'];
    $student->phone_num = $validated['phone_num'];
    $student->email = $validated['email'];
    $student->category_id = $validated['category_id'];

    // Jika password baru diisi, update password
    if (!empty($validated['password'])) {
        $student->password = bcrypt($validated['password']); // Gunakan bcrypt untuk mengenkripsi password
    }

    $student->save();

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
}


    // Hapus student
    public function destroy($id)
    {
        $student = Student::findOrFail($id); // Cari student berdasarkan ID
        $student->delete(); //dan hapus

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    // Fungsi untuk menampilkan halaman edit status pembayaran
    public function editPayment($pay_ID)
    {
        // Cari payment berdasarkan pay_ID, jika tidak ditemukan akan error
        $payment = Payment::where('pay_ID', $pay_ID)->firstOrFail();
        return view('admin.payment.edit', compact('payment')); // Kirim data payment ke view
    }

    // Fungsi untuk mengupdate status pembayaran
    public function updatePayment(Request $request, $pay_ID)
    {
        // Validasi input status pembayaran (hanya boleh confirmed, rejected, atau pending)
        $request->validate([
            'pay_status' => 'required|in:confirmed,rejected,pending',
        ]);

        $payment = Payment::where('pay_ID', $pay_ID)->firstOrFail(); // Cari payment berdasarkan pay_ID
        $payment->pay_status = $request->pay_status; // Update status
        $payment->save(); // Simpan perubahan

        return redirect()->route('admin.students.index')->with('success', 'Payment status updated successfully.');
    }
}
