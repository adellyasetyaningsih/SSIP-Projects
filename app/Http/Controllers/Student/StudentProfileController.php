<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    /**
     * Menampilkan halaman profil siswa dalam mode preview.
     */
    public function show()
    {
        $student = auth()->user();  // Ambil data siswa yang sedang login

        return view('student.editprofile', [
            'student' => $student,    // Kirim data siswa ke view
            'readonly' => true        // Mode hanya lihat, bukan edit
        ]);
    }

    /**
     * Menampilkan form edit profil siswa.
     */
    public function edit()
    {
        $student = auth()->user();

        return view('student.editprofile', [
            'student' => $student,
            'readonly' => false     // Aktifkan mode edit di blade
        ]);
    }

    /**
     * Memproses dan menyimpan perubahan profil siswa.
     */
    public function update(Request $request)
    {
        $student = auth()->user();

        // Validasi data
        $validatedData = $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'd_birth' => 'required|date',
            'phone_num' => 'required|string|max:15',
            'email' => 'required|email|unique:students,email,' . $student->student_id . ',student_id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data profil siswa
        $student->fill([
            'f_name' => $validatedData['f_name'],
            'l_name' => $validatedData['l_name'],
            'd_birth' => $validatedData['d_birth'],
            'phone_num' => $validatedData['phone_num'],
            'email' => $validatedData['email'],
        ]);

        // Jika ada file foto profil baru, update foto profil
        if ($request->hasFile('profile_picture')) {
            // Hapus foto profil lama jika ada
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);   // Hapus yang lama
            }

            // Upload foto profil baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');   // Simpan yang baru
            $student->profile_picture = $path;
        }

        // Simpan ke database
        $student->save();

        // Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('student.profile')->with('success', 'Your profile has been successfully updated ');
    }
}
