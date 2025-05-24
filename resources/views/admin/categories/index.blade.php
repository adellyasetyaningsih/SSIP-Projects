@extends('layouts.admin') {{-- Memanggil layout utama untuk admin --}}

@section('content')
<div class="container mx-auto p-6">

  {{-- === CATEGORY SECTION === --}}
  <div class="card mb-6">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Category Data</h1>
      <div class="flex items-center space-x-2">
        <input type="text" id="searchCategoryInput" placeholder="Search Category..." class="border px-3 py-2 rounded text-sm" />
        <a href="{{ route('admin.categories.create') }}#category-form" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
          Add Category
        </a>
      </div>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full text-sm border">
        <thead class="bg-yellow-400 text-black">
          <tr>
            <th class="py-3 px-4 text-left border-b">Category</th>
            <th class="py-3 px-4 text-left border-b">Price</th>
            <th class="py-3 px-4 text-left border-b">Quota</th>
            <th class="py-3 px-4 text-left border-b">Actions</th>
          </tr>
        </thead>
        <tbody id="categoryTableBody">
          @foreach($categories as $category)
            <tr class="hover:bg-gray-100">
              <td class="py-3 px-4 border-b">{{ $category->category_id }}</td>
            <td class="py-3 px-4 border-b"> Rp{{ number_format(optional($category)->price, 0, ',', '.') }}</td>
              <td class="py-3 px-4 border-b">{{ $category->quota }}</td>
              <td class="py-3 px-4 border-b flex space-x-2">
                <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
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

  {{-- === SUBJECT SECTION === --}}
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Subject Data</h1>
      <div class="flex items-center space-x-2">
        <input type="text" id="searchSubjectInput" placeholder="Search Subject..." class="border px-3 py-2 rounded text-sm" />
        <a href="{{ route('admin.subjects.create') }}#subject-form" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
          Add Subject
        </a>
      </div>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full text-sm border">
        <thead class="bg-yellow-400 text-black">
          <tr>
            <th class="py-3 px-4 text-left border-b">Subject ID</th>
            <th class="py-3 px-4 text-left border-b">Category</th>
            <th class="py-3 px-4 text-left border-b">Material Name</th>
            <th class="py-3 px-4 text-left border-b">Desc</th>
            <th class="py-3 px-4 text-left border-b">File</th>
            <th class="py-3 px-4 text-left border-b">Actions</th>
          </tr>
        </thead>
        <tbody id="subjectTableBody">
          @foreach($subjects as $subject)
            <tr class="hover:bg-gray-100">
              <td class="py-3 px-4 border-b">{{ $subject->subject_id }}</td>
              <td class="py-3 px-4 border-b">{{ $subject->category_id }}</td>
              <td class="py-3 px-4 border-b">{{ $subject->title }}</td>
              <td class="py-3 px-4 border-b">{{ $subject->desc }}</td>
              <td class="py-3 px-4 border-b max-w-[150px] truncate whitespace-nowrap overflow-hidden">
              <a href="{{ $subject->file_path }}" target="_blank" class="text-blue-500 underline" title="{{ $subject->file_path }}">
                  {{ \Illuminate\Support\Str::limit($subject->file_path, 30) }}
                </a>
              </td>
              <td class="py-3 px-4 border-b flex space-x-2">
                <a href="{{ route('admin.subjects.edit', $subject->subject_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.subjects.destroy', $subject->subject_id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                      <input type="hidden" name="subject_id" value="{{ $subject->subject_id }}">
                      <input type="hidden" name="category_id" value="{{ $subject->category_id }}">
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
  // Search for Category Table
  document.getElementById('searchCategoryInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#categoryTableBody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none'; // Tampilkan baris jika mengandung kata kunci
    });
  });

  // Search for Subject Table
  document.getElementById('searchSubjectInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#subjectTableBody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none'; // Tampilkan baris jika cocok
    });
  });
</script>
@endsection

