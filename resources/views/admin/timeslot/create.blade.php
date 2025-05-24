@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6">Add New Time Slot</h1>

  <form action="{{ route('admin.timeslots.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
      <label class="block font-medium">Time Slot ID</label>
      <input type="text" name="time_slot_id" value="{{ $nextId }}" readonly required
            class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div>
      <label class="block font-medium">Category</label>
      <select id="category_id" name="category_id" class="w-full mt-1 p-2 border border-gray-300 rounded" required onchange="filterSubjects()">
        <option value="" selected disabled>Pilih Kategori</option>
        @foreach ($categories as $category)
          <option value="{{ $category->category_id }}">{{ $category->category_id }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block font-medium">Date</label>
      <input type="date" name="date" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block font-medium">Start Time</label>
        <input type="time" name="start_time" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
      </div>
      <div>
        <label class="block font-medium">End Time</label>
        <input type="time" name="end_time" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
      </div>
    </div>

    <div>
      <label class="block font-medium">Subject</label>
      <select id="subject_id" name="subject_id" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
        <option value="" selected disabled>Pilih Subject</option>
        @foreach($subjects as $subject)
          <option value="{{ $subject->subject_id }}" data-category="{{ $subject->category_id }}">
            {{ $subject->subject_id }}
          </option> {{-- Loop subject, setiap option menyimpan subject_id sebagai value dan category_id sebagai data attribute --}}
        @endforeach
      </select>
    </div>

    <div>
      <label class="block font-medium">Teacher</label>
      <select name="teacher_id" class="w-full mt-1 p-2 border border-gray-300 rounded" required onchange="updateClassroom(this)">
        <option disabled selected>Pilih Guru</option>
        @foreach ($teachers as $teacher)
          <option value="{{ $teacher->teacher_id }}" data-classroom="{{ $teacher->classroom->name ?? '' }}">
            {{ $teacher->teacher_id }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="block font-medium">Classroom</label>
      <input type="text" name="classroom" id="classroom" class="w-full mt-1 p-2 border border-gray-300 rounded" >
    </div>

    <div class="pt-4">
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </div>
  </form>
</div>

<script>
  // Fungsi updateClassroom untuk isi input classroom otomatis saat pilih guru
  function updateClassroom(select) {
    const classroomInput = document.getElementById('classroom');
    const selectedOption = select.options[select.selectedIndex];
    const classroom = selectedOption.getAttribute('data-classroom');
    classroomInput.value = classroom ?? '';
  }
// Fungsi filterSubjects untuk filter opsi subject berdasarkan kategori yang dipilih
function filterSubjects() {
    const categorySelect = document.getElementById('category_id');
    const subjectSelect = document.getElementById('subject_id');
    const selectedCategory = categorySelect.value;

    for (let i = 0; i < subjectSelect.options.length; i++) {
      const option = subjectSelect.options[i];
      const optionCategory = option.getAttribute('data-category');

      // Jika category kosong atau sesuai category yang dipilih, tampilkan option
      if (!selectedCategory || optionCategory === selectedCategory) {
        option.style.display = '';
      } else {
        option.style.display = 'none';
      }
    }

    subjectSelect.value = ''; // Reset pilihan subject saat kategori berubah
  }

</script>
@endsection
