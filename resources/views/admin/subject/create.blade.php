@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Add New Subject</h1>

    {{-- Tampilkan pesan error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tampilkan pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM TAMBAH SUBJECT --}}
    <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-4">
        @csrf

       <div>
            <label class="block font-medium">Subject ID</label>
            <input type="text" name="subject_id" value="{{ old('subject_id') }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        {{-- Select Category --}}
        <div>
            <label class="block font-medium">Category</label>
            <select name="category_id" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category) {{-- Loop semua kategori dari controller --}} 
                    <option value="{{ $category->category_id }}" 
                    {{ old('category_id') == $category->category_id ? 'selected' : '' }}>   {{-- Cek jika sebelumnya dipilih --}}
                    {{ $category->category_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Material Name</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        <div>
            <label class="block font-medium">Description</label>
            <textarea name="desc" class="w-full mt-1 p-2 border border-gray-300 rounded" rows="3">{{ old('desc') }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Google Drive Link</label>
            <input type="url" name="file_path" value="{{ old('file_path') }}" required placeholder="https://drive.google.com/..." class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        <div class="pt-4 flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit Subject</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
        </div>
    </form>
</div>
@endsection
