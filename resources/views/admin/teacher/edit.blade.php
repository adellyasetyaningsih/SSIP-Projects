@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6 text-center text-yellow-600">Edit Teacher</h1>

  <form action="{{ route('admin.teachers.update', $teacher->teacher_id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block font-medium text-gray-700">Teacher ID</label>
      <input type="text" name="teacher_id" value="{{ $teacher->teacher_id }}" readonly class="w-full mt-1 p-2 border border-gray-300 bg-gray-100 rounded">
    </div>

    <div>
      <label class="block font-medium text-gray-700">First Name</label>
      <input type="text" name="teacher_f_name" value="{{ $teacher->teacher_f_name }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div>
      <label class="block font-medium text-gray-700">Last Name</label>
      <input type="text" name="teacher_l_name" value="{{ $teacher->teacher_l_name }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div class="pt-4 flex justify-end space-x-2">
      <a href="{{ route('admin.teachers.index') }}" 
         class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Back
      </a>

      <button type="submit" 
              class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
        Update Teacher
      </button>
    </div>
  </form>
</div>
@endsection
