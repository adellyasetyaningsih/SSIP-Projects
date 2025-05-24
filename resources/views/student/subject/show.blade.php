<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>P3K - Materi Subjek</title>
  <script src="https://cdn.tailwindcss.com"></script>
      <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>
<body class="bg-white text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow fixed top-0 left-0 right-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-2">
        <img src="{{ asset('homepage/Logo P3K.png') }}" alt="Logo P3K" class="h-16 w-16">
      </a>
      <div class="flex items-center space-x-4">
        <!-- Gambar profil user -->
        <a href="{{ route('student.edit') }}" class="block w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 hover:border-gray-500 transition">
          <img 
            src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
            alt="Profile Picture" 
            class="w-full h-full object-cover"
          />
        </a>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"
            class="bg-[#486284] text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition">Logout</button>
        </form>
      </div>
    </div>
  </header>

  <!-- Main Layout -->
  <main class="pt-24 pb-16 max-w-7xl mx-auto px-4">
    <div class="flex flex-col lg:flex-row gap-6">

      <!-- Sidebar -->
      <aside class="w-full lg:w-64 flex flex-col gap-4">
       <!-- Jadwal Les -->
        <div class="bg-yellow-300 p-4 rounded-md shadow">
          <h2 class="font-semibold text-lg mb-2">Schedule:</h2>
          <ul class="text-sm list-disc pl-5 space-y-1">
            <!-- Loop jadwal dari controller -->
            @foreach($timeSlots as $slot)
              <li>
                <!-- Tanggal, waktu mulai-selesai, nama kelas, dan nama guru -->
                <strong>{{ $slot->date }}</strong> |
                {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }} |
                Kelas: {{ $slot->classroom ?? 'Tidak tersedia' }} |
                Guru: {{ $slot->teacher ? $slot->teacher->teacher_f_name . ' ' . $slot->teacher->teacher_l_name : 'Tidak tersedia' }}
              </li>
            @endforeach
          </ul>
        </div>

        <!-- Motivation -->
        <div class="bg-blue-200 p-6 rounded-xl shadow-md w-full">
          <h2 class="text-lg font-semibold text-blue-800 mb-3">Motivasi</h2>
          <p class="text-blue-900 text-sm italic">
            "Success is the sum of small efforts, repeated day in and day out."
          </p>
          <p class="text-blue-700 text-xs mt-2 text-right">— Robert Collier</p>
        </div>
      </aside>

      <!-- Materi Content -->
      <section class="flex-1">
        <!-- Judul Subjek -->
        <div class="bg-[#9A3333] text-white p-6 rounded shadow mb-6">
          <h2 class="text-2xl font-bold">{{ $mainSubject->subject_id }}</h2>
        </div>

        <!-- Loop daftar materi -->
        @forelse($subjects as $subject)
          <div class="mb-6 p-4 bg-white border rounded shadow">
            <!-- Judul materi -->
            <h3 class="font-medium text-lg mb-2">Materi: {{ $subject->title }}</h3>

            <!-- Deskripsi materi jika ada -->
            @if($subject->desc)
              <p class="text-gray-700 mb-2">{{ $subject->desc }}</p>
            @endif

            <!-- Link ke file materi jika tersedia -->
            @if($subject->file_path)
              <a href="{{ $subject->file_path }}" target="_blank" class="text-blue-600 underline">
                Klik di sini untuk membuka materi
              </a>
            @else
              <p class="text-gray-600 italic">Belum ada file yang diunggah untuk materi ini.</p>
            @endif
          </div>
        @empty
          <!-- Jika belum ada materi -->
          <p class="text-gray-500 italic">Belum ada materi yang tersedia.</p>
        @endforelse
      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-[#BF2D32] text-white mt-20">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">
      <!-- Tambahkan konten jika perlu -->
    </div>
    <div class="text-center text-sm py-6 border-t border-white border-opacity-20">
      ©2025 P3K. All rights reserved |
      <a href="#" class="underline">Privacy & Policy</a> |
      <a href="#" class="underline">Terms & Conditions</a>
    </div>
  </footer>

</body>
</html>
