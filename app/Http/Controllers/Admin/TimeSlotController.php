<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSlot;
use App\Models\Category;
use App\Models\Subject; 
use App\Models\Teacher;


class TimeSlotController extends Controller
{
    // Menampilkan daftar timeslot
    public function index()
    {
        $time_slots = TimeSlot::all();
        return view('admin.timeslot.index', compact('time_slots'));
    }
    

   // Menampilkan form tambah timeslot
public function create()
{
    // Cari ID terkecil yang belum dipakai, supaya form bisa tampil ID yang benar
    $usedIds = TimeSlot::orderBy('time_slot_id')->pluck('time_slot_id')->toArray();
    $nextId = 1;
    foreach ($usedIds as $id) {
        if ($id == $nextId) {
            $nextId++;
        } else {
            break; // Jika ditemukan celah, langsung stop
        }
    }

    $categories = Category::all();
    $subjects = Subject::select('subject_id', 'category_id') // Ambil subject dengan field tertentu
                    ->groupBy('subject_id', 'category_id') // Grup berdasarkan subject dan kategori
                    ->get();

    $teachers = Teacher::all();

    return view('admin.timeslot.create', compact('categories', 'subjects', 'teachers', 'nextId'));
}

// Simpan timeslot baru
public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'subject_id' => 'required',
        'teacher_id' => 'required',
        'classroom' => 'required|string',
    ]);

    // Cari ID terkecil yang belum dipakai
    $usedIds = TimeSlot::orderBy('time_slot_id')->pluck('time_slot_id')->toArray();
    $nextId = 1;

    foreach ($usedIds as $id) {
        if ($id == $nextId) {
            $nextId++;
        } else {
            break;
        }
    }

    // Tambahan validasi agar tidak null
    if (!$nextId) {
        return back()->withErrors(['time_slot_id' => 'Gagal menghasilkan ID baru.']);
    }

    // Set ID baru yang sudah ditemukan ke data validasi
    $validated['time_slot_id'] = $nextId;


    TimeSlot::create($validated);

    // Redirect ke halaman list dengan pesan sukses
    return redirect()->route('admin.timeslots.index')->with('success', 'Time slot berhasil ditambahkan');
}

    // Tampilkan form edit timeslot
    public function edit($id)
    {
        $timeslot = TimeSlot::findOrFail($id);  // nama variabel harus sama dengan yang di view
        $categories = Category::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('admin.timeslot.edit', compact('timeslot', 'categories', 'subjects', 'teachers'));
    }

// Update timeslot
public function update(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'classroom' => 'required|string|max:255',
    ]);

    $timeslot = TimeSlot::findOrFail($id);

    $timeslot->update([
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'classroom' => $request->classroom,
    ]);

    return redirect()->route('admin.timeslots.index')->with('success', 'Time slot updated successfully!');
}



    // Hapus timeslot
public function destroy($id)
{
    // Hapus data timeslot yang dipilih
    $timeslot = TimeSlot::where('time_slot_id', $id)->firstOrFail();
    $timeslot->delete();

    // Update urutan time_slot_id yang lebih besar dari yang dihapus
    $timeslots = TimeSlot::where('time_slot_id', '>', $id)->orderBy('time_slot_id')->get();

    foreach ($timeslots as $ts) {
        $oldId = $ts->time_slot_id;
        $newId = $oldId - 1;

        // Update id time slot
        $ts->time_slot_id = $newId;
        $ts->save();
    }

    return redirect()->route('admin.timeslots.index')->with('success', 'Time slot deleted and IDs updated!');
}
}
