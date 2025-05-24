<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Tampilkan daftar semua guru
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teacher.index', compact('teachers'));
    }

    // Tampilkan form tambah guru dengan teacher_id otomatis
    public function create()
    {
        $lastTeacher = Teacher::orderBy('teacher_id', 'desc')->first();
        $nextIdNumber = $lastTeacher ? ((int) substr($lastTeacher->teacher_id, 1)) + 1 : 1;
        $newTeacherId = 'T' . str_pad($nextIdNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.teacher.create', compact('newTeacherId'));
    }

    // Simpan data guru baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id'    => 'required|unique:teachers,teacher_id',
            'teacher_f_name'=> 'required|string|max:255',
            'teacher_l_name'=> 'required|string|max:255',
        ]);

        Teacher::create($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }

    // Tampilkan form edit guru
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    // Update data guru
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'teacher_f_name' => 'required|string|max:255',
            'teacher_l_name' => 'required|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }


    // Hapus guru
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
