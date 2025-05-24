@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Subject</h1>

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

    {{-- FORM EDIT SUBJECT --}}
    <form action="{{ route('admin.subjects.update', $subject->subject_id) }}" method="POST" class="space-y-4"> {{-- Form untuk update subject, method POST dengan method spoofing PUT --}}
        @csrf
        @method('PUT') {{-- Spoof HTTP method menjadi PUT untuk update data --}}

        {{-- Subject ID --}}
        <div>
            <label class="block font-medium">Subject ID</label>
            <input type="text" value="{{ $subject->subject_id }}" class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100" disabled>
        </div>

        {{-- Category (disabled + hidden) --}}
        <div>
            <label class="block font-medium">Category</label>
            <select class="w-full mt-1 p-2 border border-gray-300 rounded bg-gray-100" disabled> {{-- Dropdown kategori, disabled supaya tidak bisa diubah --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" {{ $subject->category_id == $category->category_id ? 'selected' : '' }}>
                        {{ $category->category_id }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="category_id" value="{{ $subject->category_id }}"> {{-- Input hidden untuk mengirim data category_id karena select di atas disabled --}}
        </div>
        </div>

        {{-- Title --}}
        <div>
            <label class="block font-medium">Material Name</label>
            <input type="text" name="title" value="{{ old('title', $subject->title) }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-medium">Description</label>
            <textarea name="desc" class="w-full mt-1 p-2 border border-gray-300 rounded" rows="3">{{ old('desc', $subject->desc) }}</textarea>
        </div>

        {{-- Google Drive Link --}}
        <div>
            <label class="block font-medium">Google Drive Link</label>
            <input type="text" name="file_path" value="{{ old('file_path', $subject->file_path ?? '') }}" class="w-full mt-1 p-2 border border-gray-300 rounded" placeholder="https://drive.google.com/..." />
        </div>

        {{-- Buttons --}}
        <div class="pt-4 flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Subject</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
        </div>
    </form>
</div>
@endsection
