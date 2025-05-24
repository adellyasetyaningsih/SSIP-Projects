@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6">Edit Student</h1>

  {{-- Form untuk update data student --}}
  <form action="{{ route('admin.students.update', $student->student_id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT') {{-- Spoofing method PUT karena HTML hanya mendukung GET dan POST --}}

    <div>
      <label class="block">First Name</label>
       {{-- Isi input diambil dari nilai lama atau data student yang sedang diedit --}}
      <input type="text" name="f_name" value="{{ old('f_name', $student->f_name) }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
      <label class="block">Last Name</label>
      <input type="text" name="l_name" value="{{ old('l_name', $student->l_name) }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
      <label class="block">Birth Date</label>
      <input type="date" name="d_birth" value="{{ old('d_birth', $student->d_birth) }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
      <label class="block">Phone Number</label>
      <input type="text" name="phone_num" value="{{ old('phone_num', $student->phone_num) }}" class="border px-3 py-2 rounded w-full">
    </div>

    <div>
      <label class="block">Email</label>
      <input type="email" name="email" value="{{ old('email', $student->email) }}" class="border px-3 py-2 rounded w-full">
    </div>

    {{-- Dropdown untuk memilih kategori student --}}
    <div>
      <label class="block">Category</label>
      <select name="category_id" class="border px-3 py-2 rounded w-full">
        {{-- Loop semua kategori yang tersedia --}}
      @foreach($categories as $category)
          {{-- Tandai option sebagai selected jika sesuai dengan data student --}}
          <option value="{{ $category->category_id }}" {{ old('category_id', $student->category_id) == $category->category_id ? 'selected' : '' }}>
            {{ $category->category_id }}
          </option>
      @endforeach
      </select>
    </div>

    {{-- Input password baru (opsional) --}}
    <div>
      <label class="block">Password (kosongkan jika tidak ingin mengganti)</label>
      <input type="password" name="password" class="border px-3 py-2 rounded w-full" autocomplete="new-password">
    </div>

    {{-- Konfirmasi password baru --}}
    <div>
      <label class="block">Confirm Password</label>
      <input type="password" name="password_confirmation" class="border px-3 py-2 rounded w-full" autocomplete="new-password">
    </div>



    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">SAVE</button>
  
  </form>
</div>
@endsection
