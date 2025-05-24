<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Membuat tampilan responsif di perangkat mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>
<body class="bg-white text-gray-800">

  <!-- Header Start -->
  <header class="bg-white shadow fixed top-0 left-0 right-0 z-10">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <!-- Logo P3K, jika diklik scroll ke atas -->
    <a href="#top" class="flex items-center space-x-2">
      <img src="{{ asset('homepage/Logo P3K.png') }}" alt="Logo P3K" class="h-16 w-16">
    </a>
    <div class="flex items-center space-x-4">
      <!-- Icon Profil, menuju halaman edit Profile -->
      <a href="{{ route('student.edit') }}" class="block w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 hover:border-gray-500 transition">
  <img 
    src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
    alt="Profile Picture" 
    class="w-full h-full object-cover"
  />
  </a>

      <!-- Tombol Logout -->
      <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
        <button type="submit"
          class="bg-[#486284] text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition">Logout</button>
      </form>
    </div>
  </div>
</header>
<!-- Header End -->

  <!-- Main Content Start -->
  <main id="top" class="pt-24 px-4 pb-24 max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6">
      <!-- Left content (Subject cards) -->
      <div class="flex-1">
        <h1 class="text-2xl font-bold mb-6">Welcome to {{ $category }} Class! 👋</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Subject Cards Start -->
          @foreach($subjects as $subject)
              <!-- Setiap subject ditampilkan sebagai kartu -->
              <a href="{{  route('student.subject.show', $subject->subject_id) }}" class="block">
                  <div class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transition transform">
                    <!-- Header card berisi ID subject -->
                      <div class="bg-[#9A3333] p-4 font-semibold text-lg text-white">
                          {{ $subject->subject_id }}
                      </div>
                      <!-- Bagian bawah card berisi nama guru -->
                      <div class="p-4 text-sm text-black">
                          {{ $subject->teacher_name }}
                      </div>
                  </div>
              </a>
          @endforeach
          <!-- Subject Cards End -->
        </div>
      </div>

      <!-- Sidebar (Schedule & Motivation) -->
      <aside class="w-full lg:w-64 flex flex-col gap-4">
        <!-- Schedule Section -->
        <div class="bg-yellow-300 p-4 rounded-md shadow md:w-80">
          <h2 class="font-semibold text-lg mb-2">Schedule:</h2>
          <ul class="text-sm list-disc pl-5 space-y-1">
              @foreach($timeSlots as $timeSlot)
                  <!-- Tampilkan setiap jadwal pelajaran -->
                  <li>
                      <strong>{{ $timeSlot->date }}</strong> |
                      {{ \Carbon\Carbon::parse($timeSlot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($timeSlot->end_time)->format('H:i') }} |
                      {{ $timeSlot->subject->subject_id ?? 'No Subject' }} |
                      {{ $timeSlot->classroom }}
                  </li>
              @endforeach
          </ul>
        </div>
        <!-- Motivation Section -->
        <div class="bg-blue-200 p-6 rounded-xl shadow-md w-full md:w-80">
          <h2 class="text-lg font-semibold text-blue-800 mb-3">Motivation</h2>
          <p class="text-blue-900 text-sm italic">
            "Success is the sum of small efforts, repeated day in and day out."
          </p>
          <p class="text-blue-700 text-xs mt-2 text-right">— Robert Collier</p>
        </div>
      </aside>
    </div>
  </main>
  <!-- Main Content End -->

  <!-- Footer Start -->
  <footer class="bg-[#BF2D32] text-white mt-40">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">
      <!-- Optional Footer content -->
    </div>
    <div class="text-center text-sm py-6 border-t border-white border-opacity-20">
      ©2025 P3K. All rights reserved |
      <a href="#" class="underline">Privacy & Policy</a> |
      <a href="#" class="underline">Terms & Conditions</a>
    </div>
  </footer>
  <!-- Footer End -->

</body>
</html>
