@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <div class="card">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Admin List</h1>
      <div class="flex items-center space-x-2">
        <input type="text" id="searchInput" placeholder="Search Admin..." class="border px-3 py-2 rounded text-sm" />
        <a href="{{ route('admin.admins.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
          Add Admin
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
      <table class="min-w-full text-sm border">
        <thead class="bg-yellow-400 text-black">
          <tr>
            <th class="py-3 px-4 text-left border-b">Email</th>
            <th class="py-3 px-4 text-left border-b">Name</th>
            <th class="py-3 px-4 text-left border-b">Password</th>
            <th class="py-3 px-4 text-left border-b">Actions</th>
          </tr>
        </thead>
        <tbody id="AdminTableBody">
          @forelse($admins as $admin)
          <tr class="hover:bg-gray-100">
            <td class="py-3 px-4 border-b">{{ $admin->admin_email }}</td>
            <td class="py-3 px-4 border-b">{{ $admin->admin_name }}</td>
            <td class="py-3 px-4 border-b">
              <span class="text-gray-400 italic">Hidden</span>
            </td>
            <td class="py-3 px-4 border-b flex space-x-2">
              <a href="{{ route('admin.admins.edit', $admin->admin_email) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
              <form action="{{ route('admin.admins.destroy', $admin->admin_email) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center py-4 text-gray-500">No admins found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  document.getElementById('searchInput').addEventListener('keyup', function () {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('#AdminTableBody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
</script>
@endsection

