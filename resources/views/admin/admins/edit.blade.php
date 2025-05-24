@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Admin</h1>

  <form action="{{ route('admin.admins.update', $admin->admin_email) }}" method="POST"class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')

    {{-- Show validation errors --}}
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div>
      <label class="block font-medium">Admin Name</label>
      <input type="text" name="admin_name" value="{{ old('admin_name', $admin->admin_name) }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div>
      <label class="block font-medium">Email</label>
      <input type="email" name="admin_email" value="{{ old('admin_email', $admin->admin_email) }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div>
      <label class="block font-medium">New Password <small class="text-gray-500">(kosongkan jika tidak ingin mengganti password)</small></label>
      <input type="password" name="admin_password" class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div>
      <label class="block font-medium">Confirm New Password</label>
      <input type="password" name="admin_password_confirmation" class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div class="pt-4 text-right">
      <a href="{{ route('admin.admins.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2">Update Admin</button>
    </div>
  </form>
</div>
@endsection
