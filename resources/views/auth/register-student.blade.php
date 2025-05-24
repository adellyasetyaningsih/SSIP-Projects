<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />
      <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>

<body class="p-10 bg-yellow-400 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-xl">

    <h1 class="text-3xl text-center text-red-700 font-mono font-extrabold mb-4">
      <i class="fa-solid fa-user"></i> Registration
    </h1>
    <hr class="mb-4 border-blue-700">

    {{-- Error Handling --}}
    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        <ul>
          @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Formulir registrasi -->
    <form action="{{ route('register.student') }}" method="POST">
      @csrf <!-- CSRF token Laravel -->

      {{-- First Name --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="Enter your first name">
      </div>

      {{-- Last Name --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="Enter your last name">
      </div>

      {{-- Date of Birth --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Date of Birth</label>
        <input type="date" name="dob" value="{{ old('dob') }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400">
      </div>

      {{-- Phone Number --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Phone Number</label>
        <input type="tel" name="phone" value="{{ old('phone') }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="Enter phone number">
      </div>

      {{-- Email --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="name@gmail.com">
      </div>

      {{-- Password --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="Enter your password">
      </div>

      {{-- Confirm Password --}}
      <div class="mb-2">
        <label class="block text-yellow-500 mb-2">Confirm Password</label>
        <input type="password" name="password_confirmation" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400"
               placeholder="Confirm your password">
      </div>

      {{-- Package (Category from DB) --}}
      <div class="mb-2">
        <label for="package" class="block text-yellow-500 mb-2">Package</label>
        <select name="category_id" id="package" onchange="showPrice()" required
        class="font-semibold w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-teal-700">
            <option value="">Select a package</option>

            <!-- Iterasi kategori dari database -->
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                        data-price="{{ $category->price }}"
                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                    {{ strtoupper($category->category_id) }} <!-- Menampilkan category_id yang sesuai -->
                </option>
            @endforeach
        </select>

        <!-- Menampilkan harga berdasarkan paket yang dipilih -->
        <div id="price-container" class="mt-2 text-right text-pink-600 font-semibold"></div>
      </div>

      {{-- Submit --}}
      <div class="mt-4">
        <button type="submit"
                class="w-full py-2 bg-blue-400 text-white rounded-md hover:bg-blue-800 font-semibold transition">
          Sign Up
        </button>
      </div>
    </form>

    <!-- Link untuk login jika sudah punya akun -->
    <div class="mt-4 text-center">
      <p class="text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login.student') }}" class="text-blue-600 hover:underline font-semibold">Login here</a>
      </p>
    </div>
  </div>

  {{-- Show price dinamis script --}}
  <script>
    function showPrice() {
      const select = document.getElementById('package');
      const selectedOption = select.options[select.selectedIndex];
      const price = selectedOption.getAttribute('data-price');
      const container = document.getElementById('price-container');

      // Tampilkan harga jika ada
      container.textContent = price ? 'Harga: Rp. ' + parseInt(price).toLocaleString('id-ID') + ',-' : '';
    }

    // Tampilkan harga saat halaman dimuat (jika paket sudah dipilih sebelumnya)
    window.addEventListener('DOMContentLoaded', showPrice);
  </script>
</body>
</html>
