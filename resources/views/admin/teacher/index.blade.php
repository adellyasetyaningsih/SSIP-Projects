@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">

  {{-- === TEACHER SECTION === --}}
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Teacher Data</h1>
      <div class="flex items-center space-x-2">
        <input type="text" id="searchInput" placeholder="Search Teacher..." class="border px-3 py-2 rounded text-sm" />
        <a href="{{ route('admin.teachers.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
          Add Teacher
        </a>
      </div>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full text-sm border">
        <thead class="bg-yellow-400 text-black">
          <tr>
            <th class="py-3 px-4 text-left border-b">ID</th>
            <th class="py-3 px-4 text-left border-b">First Name</th>
            <th class="py-3 px-4 text-left border-b">Last Name</th>
            <th class="py-3 px-4 text-left border-b">Actions</th>
          </tr>
        </thead>
        <tbody id="TeacherTableBody">
          @foreach($teachers as $teacher)
            <tr class="hover:bg-gray-100">
              <td class="py-3 px-4 border-b">{{ $teacher->teacher_id }}</td>
              <td class="py-3 px-4 border-b">{{ $teacher->teacher_f_name }}</td>
              <td class="py-3 px-4 border-b">{{ $teacher->teacher_l_name }}</td>
              <td class="py-3 px-4 border-b flex space-x-2">
                <a href="{{ route('admin.teachers.edit', $teacher->teacher_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.teachers.destroy', $teacher->teacher_id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded ml-2">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#TeacherTableBody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
</script>
@endsection

