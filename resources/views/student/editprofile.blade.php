<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />
</head>

<body class="flex justify-center p-10 bg-teal-700">
  <div class="flex justify-center items-center min-h-screen w-full">
    <div class="bg-white rounded-md shadow-lg p-4 px-4 md:px-20 lg:px-40 max-w-4xl min-h-[500px] w-full">

      <!-- Pesan sukses setelah update -->
      @if(session('success'))
      <div id="success-message"  class="bg-green-500 text-white p-3 rounded mb-4 transition-opacity duration-500 opacity-100">
         {{ session('success') }}
      </div>
       @endif

      <!-- Judul Halaman & Student ID -->
      <h1 class="text-3xl text-center text-yellow-400 font-mono font-extrabold mb-1">
        <i class="fa-solid fa-user"></i> {{ $readonly ? 'Your Profile' : 'Edit Profile' }}
      </h1>
      <p class="text-center text-base font-semibold mb-4 italic">
        Your ID: {{ $student->student_id ?? 'ID not found' }}
      </p>
      <hr class="my-3 border-orange-800" />

      <!-- Tampilan Preview jika readonly -->
      @if($readonly)
      <div id="preview" class="mb-8 flex flex-col items-center justify-center">
        <h2 class="text-xl font-bold text-blue-600 mb-4">Your Profile Preview</h2>
        <div class="flex flex-col items-center">
          <!-- Gambar profil -->
          <img
            id="preview-image"
            src="{{ $student->profile_picture ? asset('storage/'.$student->profile_picture) : 'https://via.placeholder.com/150' }}"
            class="w-32 h-32 rounded-full object-cover mt-2 border"
            alt=" "
          />
          <!-- Informasi user -->
          <ul class="space-y-2 text-gray-800 mt-4 text-center">
            <li><strong>Full Name:</strong> {{ $student->f_name }} {{ $student->l_name }}</li>
            <li><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($student->d_birth)->translatedFormat('l, d-m-Y') }}</li>
            <li><strong>Phone Number:</strong> {{ $student->phone_num }}</li>
            <li><strong>Email:</strong> {{ $student->email }}</li>
          </ul>
        </div>
        <div class="flex mt-6 space-x-4">
          <a href="{{ route('student.dashboard') }}" class="bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-500 transition">
            Back to Dashboard
          </a>
          <a href="{{ route('student.edit', $student->student_id) }}" class="bg-pink-400 text-white py-2 px-4 rounded-md hover:bg-pink-500 transition">
            Edit Profile
          </a>
        </div>
      </div>
      @endif

      <!-- Form Edit Profile -->
      @if(!$readonly)
      <div id="form-section" class="mt-8">
        @if($student && $student->student_id)
        <form id="profile-form" method="POST" enctype="multipart/form-data" action="{{ route('student.update') }}">
          @csrf
          @method('PUT')

          <!-- Upload foto profil -->
          <div class="flex flex-col items-center mb-8">
            <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden shadow">
              <img
                id="profileImage"
                src="{{ $student->profile_picture ? asset('storage/'.$student->profile_picture) : 'https://via.placeholder.com/150' }}"
                alt=" "
                class="w-full h-full object-cover"
              />
            </div>
            <label for="file-upload" class="mt-4 cursor-pointer bg-pink-400 text-white py-2 px-4 rounded-md hover:bg-pink-500 transition">
              Change Picture
            </label>
            <input id="file-upload" type="file" accept="image/*" class="hidden" name="profile_picture" onchange="loadFile(event)" />
          </div>

          <!-- Form input data -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- First Name -->
            <div>
              <label for="first-name" class="block text-indigo-500 mb-2">First Name</label>
              <input type="text" id="first-name" name="f_name" value="{{ old('f_name', $student->f_name) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Last Name -->
            <div>
              <label for="last-name" class="block text-indigo-500 mb-2">Last Name</label>
              <input type="text" id="last-name" name="l_name" value="{{ old('l_name', $student->l_name) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Tanggal Lahir -->
            <div>
              <label for="dob" class="block text-indigo-500 mb-2">Date of Birth</label>
              <input type="date" id="dob" name="d_birth"
                value="{{ old('d_birth', \Carbon\Carbon::parse($student->d_birth)->format('Y-m-d')) }}" required
                class="w-full text-gray-700 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Nomor HP -->
            <div>
              <label for="phone-number" class="block text-indigo-500 mb-2">Phone Number</label>
              <input type="tel" id="phone-number" name="phone_num" value="{{ old('phone_num', $student->phone_num) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <!-- Email -->
            <div class="md:col-span-2">
              <label for="email" class="block text-indigo-500 mb-2">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

             <!-- Tombol submit -->
            <div class="mt-6 md:col-span-2">
              <button type="submit"
                class="w-full py-2 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 font-semibold transition">
                Save
              </button>
            </div>
          </div>
        </form>
        @else
        <!-- Jika student ID tidak tersedia -->
        <p class="text-red-600 font-semibold">Student ID not available. Cannot submit form.</p>
        @endif
      </div>
      @endif

    </div>
  </div>

  <!-- Script untuk preview foto dan menyembunyikan pesan sukses -->
  <script>
    function loadFile(event) {
      const file = event.target.files[0];
      if (file) {
        const src = URL.createObjectURL(file);
        const image = document.getElementById('profileImage');
        const previewImage = document.getElementById('preview-image');
        if (image) image.src = src;
        if (previewImage) previewImage.src = src;
      }
    }
    // Sembunyikan pesan sukses secara otomatis setelah 2 detik
    setTimeout(() => {
      const message = document.getElementById('success-message');
      if (message) {
        message.classList.remove('opacity-100');
        message.classList.add('opacity-0');
        setTimeout(() => {
          message.style.display = 'none';
        }, 500); // nunggu transisi selesai
      }
    }, 2000);
  </script>
</body>
</html>
