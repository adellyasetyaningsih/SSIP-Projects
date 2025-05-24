@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Add New Category</h1>

  {{-- Tampilkan pesan error jika validasi gagal --}}
  @if ($errors->any()) {{-- Mengecek apakah ada error validasi --}}
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Tampilkan pesan sukses jika tersedia --}}
  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">  {{-- Form untuk menyimpan kategori, dikirim ke route "store" --}}
    @csrf {{-- Token keamanan Laravel untuk mencegah CSRF --}}

    {{-- Input Category ID --}}
    <div>
      <label class="block font-medium">Category ID</label>
      <input type="text" name="category_id" value="{{ old('category_id') }}"
             required placeholder="UTBK001"
             class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    {{-- Input Kuota --}}
    <div>
      <label class="block font-medium">Price (Rp)</label>
      <input type="number" name="price" value="{{ old('price') }}"
             required min="0"
             class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    {{-- Tombol Submit dan Kembali --}}
    <div>
      <label class="block font-medium">Quota</label>
      <input type="number" name="quota" value="{{ old('quota') }}"
             required min="1"
             class="w-full mt-1 p-2 border border-gray-300 rounded">
    </div>

    <div class="pt-4 flex gap-2">
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit Category</button>
      <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back</a>
    </div>
  </form>
</div>
@endsection
