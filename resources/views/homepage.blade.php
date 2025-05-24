<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Mengatur karakter encoding ke UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Membuat tampilan responsif untuk perangkat mobile -->
  <title>P3K Homepage</title> <!-- Judul halaman yang tampil di tab browser -->

  <!-- Menggunakan Tailwind CSS melalui CDN untuk styling -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Import Swiper CSS untuk slider carousel -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- Import Swiper JS untuk fitur carousel slider -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Import Alpine.js untuk fungsi reaktivitas ringan (digunakan di navbar) -->
  <script src="https://unpkg.com/alpinejs@3.13.5/dist/cdn.min.js" defer></script>

  <!-- Import AOS (Animate on Scroll) CSS untuk animasi saat scroll -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Favicon icon untuk halaman (logo kecil di tab browser) -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

  <!-- Konfigurasi Tailwind tambahan -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          keyframes: {
            // Animasi custom: efek membesar halus
            'pulse-smooth': {
              '0%, 100%': { transform: 'scale(1)' },
              '50%': { transform: 'scale(1.05)' },
            },
          },
          animation: {
            // Definisi animasi dengan durasi 3 detik berulang terus
            'pulse-smooth': 'pulse-smooth 3s infinite',
          },
          colors: {
            // Warna-warna kustom untuk branding
            primary: '#486284',
            pinklight: '#FBD3D3',
            pinkhover: '#f8bdbd',
            yellowcircle: '#FDCC4E',
          }
        }
      }
    }
  </script>
</head>

<body class="flex flex-col min-h-screen text-primary scroll-smooth">

  <!-- Navbar Start -->
<header x-data="{ open: false }" class="w-full py-4 shadow-md fixed top-0 bg-white z-50">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-4">
    <!-- Logo -->
    <a href="#top" class="flex items-center">
      <img src="{{ asset('homepage/Logo P3K.png') }}" alt="Logo p3k"class="h-16 w-auto">
    </a>

    <!-- Hamburger Button (visible on mobile) -->
    <button @click="open = !open" class="md:hidden focus:outline-none text-2xl">
      <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex flex-1 justify-center space-x-8 text-lg font-medium">
      <a href="#top" class="hover:text-gray-300 transition">Home</a>
      <a href="#why-p3k" class="hover:text-gray-300 transition">Why P3K?</a>
      <a href="#teachers" class="hover:text-gray-300 transition">Teachers</a>
      <a href="#category" class="hover:text-gray-300 transition">Category</a>
      <a href="#testimony" class="hover:text-gray-300 transition">Testimony</a>
      <a href="#contact" class="hover:text-gray-300 transition">Contact</a>
    </nav>

    <!-- Buttons (Desktop only) -->
    <div class="space-x-4 hidden md:flex">
    <a href="{{ route('register.student') }}" class="px-4 py-2 bg-white text-primary border border-primary rounded-full hover:bg-gray-300 hover:border-gray-300 hover:text-white">Sign-up</a>
    <a href="{{ route('login.student') }}" class="px-4 py-2 bg-primary text-white rounded-full hover:bg-gray-300">Login</a>
  </div>

  <!-- Mobile Menu -->
  <nav x-show="open" x-transition class="md:hidden px-4 pt-4 pb-2 space-y-2 text-lg font-medium">
    <a href="#top" class="block hover:text-gray-300">Home</a>
    <a href="#why-p3k" class="block hover:text-gray-300">Why P3K?</a>
    <a href="#teachers" class="block hover:text-gray-300">Teachers</a>
    <a href="#category" class="block hover:text-gray-300">Category</a>
    <a href="#testimony" class="block hover:text-gray-300">Testimony</a>
    <a href="#contact" class="block hover:text-gray-300">Contact</a>
    <div class="pt-2 space-x-2">
    <a href="{{ route('register.student') }}" class="px-4 py-2 bg-white text-primary border border-primary rounded-full hover:bg-gray-300 hover:border-gray-300 hover:text-white">Sign-up</a>
    <a href="{{ route('login.student') }}" class="px-4 py-2 bg-primary text-white rounded-full hover:bg-gray-300">Login</a>
    </div>
  </nav>
</header>
<!-- Navbar End -->

  <!-- Hero Section Start-->
  <section id="top" class="pt-32 pb-16 bg-white min-h-screen flex items-center justify-center">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center px-4 gap-12">
      <!-- Left Content Start-->
      <div class="flex-1 text-black">
        <p class="uppercase text-sm font-semibold mb-2">Learn Smarter, Dream Bigger</p>
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
          Ready to Make Learning Exciting and Effective?
        </h1>
        <p class="text-base text-gray-600 mb-8">
          Deadass tired of the same old boring study grind? You been puttin' in the work but still feelin' lost? 
          P3K gonna flip the script and make your learnin' straight fire! 
          We got the cheat codes to make tough stuff easy to get. 
          Come through and level up your brain game!
        </p>
        <div class="flex flex-wrap gap-4">
          <a href="{{ route('register.student') }}" class="px-6 py-3 bg-pinklight text-primary rounded-full font-semibold hover:bg-yellowcircle transition active:bg-black active:text-white">Join a Class</a>
          <a href="#category" class="px-6 py-3 border border-primary rounded-full font-semibold text-primary hover:bg-yellowcircle hover:border-yellowcircle transition active:bg-black active:border-black active:text-white">View Courses</a>
        </div>
      </div>
      <!-- Left Content End -->

      <!-- Right Logo Start -->
      <div class="flex-1 flex justify-center relative">
        <div 
          class="w-72 h-72 bg-yellowcircle rounded-full flex items-center justify-center relative
                 animate-pulse-smooth transition-colors duration-300
                 hover:bg-pinklight active:bg-pinkhover">
          <img src="{{ asset('homepage/Logo P3K.png') }}" alt="Logo p3k" class="w-37 h-auto relative z-10 transition-transform duration-300 hover:scale-110">
        </div>
      </div>
      <!-- RIght Logo End -->
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- WhatsApp Floating Button -->
  <a href="https://wa.me/6281319201773" target="_blank" class="fixed bottom-5 right-5 z-50">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="h-12 w-12 md:h-14 md:w-14 rounded-full shadow-lg hover:scale-110 transition-transform duration-200 ease-in-out">
  </a>

  <!-- Benefits Section with AOS Animation -->
  <section id="why-p3k" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
    
    <!-- Heading -->
    <div class="text-center mb-16" data-aos="fade-up">
      <h2 class="text-4xl md:text-5xl font-extrabold text-black mb-4 leading-tight">
        The Benefits by<br />
        Joining P3K!
      </h2>
      <p class="text-gray-600 text-lg md:text-xl">
        Discover a learning journey that's engaging, focused, and built to help you succeed — all with P3K
      </p>
    </div>

    <!-- Features Grid -->
    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
      
      <!-- Feature 1 -->
      <div class="flex flex-col items-center text-center p-6 bg-yellowcircle rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('homepage/icon 1.png') }}" alt="icon 1" class="w-20 h-20 mb-6" />
        <h3 class="text-xl font-bold text-black mb-2">Fun Learning Experience</h3>
        <p class="text-black text-sm">
          Study with inspiring mentors who make every session exciting and easy to understand!        
        </p>
      </div>

      <!-- Feature 2 -->
      <div class="flex flex-col items-center text-center p-6 bg-yellowcircle rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
        <img src="{{ asset('homepage/icon 2.png') }}" alt="icon 2" class="w-20 h-20 mb-6" />
        <h3 class="text-xl font-bold text-black mb-2">Updated Learning Materials</h3>
        <p class="text-black text-sm">
          Always fresh and aligned with the latest syllabus to keep you one step ahead.        
        </p>
      </div>

      <!-- Feature 3 -->
      <div class="flex flex-col items-center text-center p-6 bg-yellowcircle rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
        <img src="{{ asset('homepage/icon 3.png') }}" alt="icon 3" class="w-20 h-20 mb-6" />
        <h3 class="text-xl font-bold text-black mb-2">Practice Tests and Challenges</h3>
        <p class="text-black text-sm">
          Boost your skills with HOTS-based quizzes and detailed discussions.
        </p>
      </div>

      <!-- Feature 4 -->
      <div class="flex flex-col items-center text-center p-6 bg-yellowcircle rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
        <img src="{{ asset('homepage/icon 4.png') }}" alt="icon 4" class="w-20 h-20 mb-6" />
        <h3 class="text-xl font-bold text-black mb-2">Motivated Learning Community</h3>
        <p class="text-black text-sm">
          Join a community of dream-chasers who are passionate about reaching their goals together!        
        </p>
      </div>

    </div>
    </div>
  </section>
  <!-- Benefits Section End-->

  <!-- Teachers Section Start -->
  <section id="teachers" class="py-16 bg-[#A2D9EB]">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-extrabold text-center text-primary mb-12">
      Meet Our Awesome Teachers!
      </h2>

    <!-- Swiper container -->
    <div class="swiper-container">
      <div class="swiper-wrapper">
        
        <!-- Teacher Card 1 -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Agus Santoso.png') }}" alt="Agus" class="w-full h-48 object-contain">
            </div>            
            <h3 class="text-xl font-bold text-primary mb-1">Agus Santoso</h3>
            <p class="text-sm text-gray-600">Institut Teknologi Bandung</p>
            <p class="text-sm text-gray-600">Penalaran Umum</p>
          </div>
        </div>
        <!-- Teacher Card 1 End -->

        <!-- Teacher Card 2 Start -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Budi Raharjo.png') }}" alt="Budi" class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Budi Raharjo</h3>
            <p class="text-sm text-gray-600">Universitas Padjadjaran</p>
            <p class="text-sm text-gray-600">Pengetahuan & Pemahaman Umum</p>
          </div>
        </div>
        <!-- Teacher Card 2 End -->

        <!-- Teacher Card 3 Start-->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Clara Wijaya.png') }}" alt="Clara" class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Clara Wijaya</h3>
            <p class="text-sm text-gray-600">National University of Singapore</p>
            <p class="text-sm text-gray-600">Pemahaman Bacaan & Menulis</p>
          </div>
        </div>
        <!-- Teacher Card 3 End -->

        <!-- Teacher Card 4 Start -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Dimas Prasetya.png') }}" alt="Dimas" class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Dimas Prasetya</h3>
            <p class="text-sm text-gray-600">Universitas Indonesia</p>
            <p class="text-sm text-gray-600">Penalaran Matematika</p>
          </div>
        </div>
        <!-- Teacher Card 4 End -->

        <!-- Teacher Card 5 Start -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Eka Lestari.png') }}" alt="Eka"class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Eka Lestari</h3>
            <p class="text-sm text-gray-600">Universitas Gadjah Mada</p>
            <p class="text-sm text-gray-600">Physics</p>
          </div>
        </div>
        <!-- Teacher Card 5 End -->

        <!-- Teacher Card 6 Start -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Fajar Putra.png') }}" alt="Fajar" class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Fajar Putra</h3>
            <p class="text-sm text-gray-600">Institut Teknologi Sepuluh Nopember</p>
            <p class="text-sm text-gray-600">Math</p>
          </div>
        </div>
        <!-- Teacher Card 6 End -->

        <!-- Teacher Card 7 Start -->
        <div class="swiper-slide flex justify-center">
          <div class="bg-white rounded-2xl p-6 shadow-lg w-72 text-center hover:scale-105 transition">
            <div class="w-28 h-24 mx-auto rounded-t-2xl mb-4 flex items-center justify-center">
              <img src="{{ asset('homepage/Gina Ramadhani.png') }}" alt="Gina" class="w-full h-48 object-cover">
            </div>
            <h3 class="text-xl font-bold text-primary mb-1">Gina Ramadhani</h3>
            <p class="text-sm text-gray-600">University Malaya</p>
            <p class="text-sm text-gray-600">English</p>
          </div>
        </div>
        <!-- Teacher Card 7 End -->

      </div>
    </div>
    </div>
  </section>
  <!-- Teacher Section End -->
  
  <!-- Categories Section Start -->
<section id="category" class="bg-white py-16 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
    <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-6">
      Pick a category that's right for you
    </h2>
    <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
      We offer various programs tailored for your academic success. Choose your path and start learning with us!
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Senior High School Card -->
      <div class="border-2 border-primary rounded-2xl p-8 bg-white shadow-md hover:shadow-lg transform transition-all hover:scale-105">
        <h3 class="text-xl font-bold mb-4 text-primary">Senior High School</h3>
        <p class="text-3xl font-extrabold mb-4 text-primary">Rp 1.500.000<span class="text-base font-medium">/month</span></p>
        <ul class="text-left space-y-2 text-gray-700">
          <li>✅ Physics</li>
          <li>✅ Math</li>
          <li>✅ English</li>
        </ul>
        <a href="{{ route('register.student') }}">
        <button class="mt-6 w-full bg-primary text-white font-bold py-2 rounded-xl hover:bg-[#384b6b] active:bg-black transition">
          Start Learning
        </button>
        </a>
      </div>

      <!-- UTBK Card (Best Seller) -->
      <div class="relative bg-primary text-white rounded-2xl p-8 shadow-2xl transform transition-all hover:scale-105">
        <!-- Best Seller Ribbon -->
        <div class="absolute -top-4 -right-4 bg-yellow-400 text-primary font-bold text-xs py-1 px-4 rounded-full animate-bounce shadow-lg">
          Best Seller
        </div>
        <h3 class="text-xl font-bold mb-4">UTBK</h3>
        <p class="text-3xl font-extrabold mb-4">Rp 2.000.000<span class="text-base font-medium">/month</span></p>
        <ul class="text-left space-y-2 text-gray-100">
          <li>✅ Penalaran Umum</li>
          <li>✅ Pengetahuan & Pemahaman Umum</li>
          <li>✅ Pemahaman Bacaan dan Menulis</li>
          <li>✅ Pengetahuan Kuantitatif</li>
          <li>✅ Literasi Bahasa Indonesia</li>
          <li>✅ Literasi Bahasa Inggris</li>
          <li>✅ Penalaran Matematika</li>
        </ul>
        <a href="{{ route('register.student') }}">
        <button class="mt-6 w-full bg-white text-primary font-bold py-2 rounded-xl hover:bg-gray-200 active:bg-black active:text-white transition">
          Start Learning
        </button>
        </a>
      </div>

      <!-- SEKDIN Card -->
      <div class="border-2 border-primary rounded-2xl p-8 bg-white shadow-md hover:shadow-lg transform transition-all hover:scale-105">
        <h3 class="text-xl font-bold mb-4 text-primary">SEKDIN</h3>
        <p class="text-3xl font-extrabold mb-4 text-primary">Rp 1.800.000<span class="text-base font-medium">/month</span></p>
        <ul class="text-left space-y-2 text-gray-700">
          <li>✅ TWK</li>
          <li>✅ TIU</li>
          <li>✅ TKP</li>
        </ul>
        <a href="{{ route('register.student') }}">
        <button class="mt-6 w-full bg-primary text-white font-bold py-2 rounded-xl hover:bg-[#384b6b] active:bg-black transition">
          Start Learning
        </button>
        </a>
      </div>
    </div>

    <!-- Payment Methods -->
    <div class="mt-20 text-center">
      <h4 class="text-lg font-bold text-primary mb-4">Payment Methods</h4>
      <div class="flex flex-wrap justify-center items-center gap-6">
        <img src="{{ asset('homepage/Logo BRI.png') }}" alt="BRI" class="h-8 w-auto">
        <img src="{{ asset('homepage/Logo BCA.png') }}" alt="BCA" class="h-8 w-auto">
        <img src="{{ asset('homepage/Logo MANDIRI.png') }}" alt="MANDIRI" alt="Mandiri" class="h-8 w-auto">
        <img src="{{ asset('homepage/Logo BNI.png') }}" alt="BNI"class="h-8 w-auto">
      </div>
    </div>
  </div>
</section>
<!-- Categories Section End -->


<!-- Testimonial Section Start -->
<section id="testimony"  x-data="testimonialSlider()" x-init="start()" class="bg-white py-16 px-4 md:px-12">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-[#000000] mb-4">
      Join Thousands Who’ve <br class="hidden md:block" /> Leveled Up With Us
    </h2>
    <p class="text-black text-lg md:text-xl mb-12">
      From better grades to greater confidence, our students are seeing real results—and they’re loving the journey.
    </p>

    <!-- Slides -->
    <div class="relative overflow-hidden">
      <div class="flex transition-all duration-700" :style="`transform: translateX(-${current * 100}%);`">
        <!-- Slide 1 -->
        <div class="min-w-full flex justify-center px-4">
          <div class="bg-gray-300 p-6 rounded-2xl shadow-md w-full max-w-md text-left">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-10 h-10 bg-[#f8fafc] rounded-full"></div>
              <div>
                <h4 class="font-semibold text-[#000000]">Anisa Rahma</h4>
                <p class="text-sm text-[#486284]">Depok, Indonesia</p>
              </div>
              <div class="ml-auto font-semibold text-[#486284]">4.9</div>
            </div>
            <p class="text-[#486284]">
              “I love how the lessons are personalized. My tutor understood how I learn best and made even the hardest topics manageable.”
            </p>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="min-w-full flex justify-center px-4">
          <div class="bg-gray-300 p-6 rounded-2xl shadow-md w-full max-w-md text-left">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-10 h-10 bg-[#f8fafc] rounded-full"></div>
              <div>
                <h4 class="font-semibold text-[#000000]">Rizky Ahmad</h4>
                <p class="text-sm text-[#486284]">Bogor, Indonesia</p>
              </div>
              <div class="ml-auto font-semibold text-[#486284]">4.7</div>
            </div>
            <p class="text-[#486284]">
              “The classes are flexible, the tutors are fun but focused, and I improved my grades in just a month. Also helped me prep for my university entrance test!”
            </p>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="min-w-full flex justify-center px-4">
          <div class="bg-gray-300 p-6 rounded-2xl shadow-md w-full max-w-md text-left">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-10 h-10 bg-[#f8fafc] rounded-full"></div>
              <div>
                <h4 class="font-semibold text-[#000000]">Nadya Putri</h4>
                <p class="text-sm text-[#486284]">Jakarta, Indonesia</p>
              </div>
              <div class="ml-auto font-semibold text-[#486284]">4.8</div>
            </div>
            <p class="text-[#486284]">
              “I used to feel so lost in math class. After just a few sessions here, things started to click! The tutor made it super easy to follow—now I actually enjoy learning.”
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Dots and Arrows -->
    <div class="flex items-center justify-center gap-6 mt-8">
      <!-- Dots Start -->
      <div class="flex gap-2">
        <template x-for="(dot, index) in total" :key="index">
          <div 
            class="w-3 h-3 rounded-full cursor-pointer" 
            :class="current === index ? 'bg-[#000000]' : 'bg-gray-300'" 
            @click="goTo(index)">
          </div>
        </template>
      </div>
      <!-- Dots End -->

      <!-- Arrows Start -->
      <div class="flex gap-4">
        <button @click="prev" class="p-2 bg-[#486284] text-white rounded-full hover:bg-[#364a66] transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
        <button @click="next" class="p-2 bg-[#486284] text-white rounded-full hover:bg-[#364a66] transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
      <!-- Arrows End -->
    </div>
    <!-- Dots and Arrows End -->
  </div>
</section>
<!-- Testimonial Section End -->


<!-- Footer Section Start -->
<footer id="contact" class="bg-[#BF2D32] text-white py-12 px-6 md:px-20">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
    
    <!-- Logo + Mission -->
    <div>
      <a href="#top" onclick="scrollToTop()" class="text-2xl font-bold mb-4 inline-block">
        <img src="{{ asset('homepage/Logo P3K.png') }}" alt="Logo p3k" class="h-16 w-auto">
      </a>
      <p class="text-sm text-whitemb-6 mt-2">
        Our Mission: To empower your learning journey and help you unlock your potential!
      </p>
      
      <!-- Social Icons Start -->
      <div class="flex space-x-4">
        <a href="#" class="bg-white text-[#BF2D32] p-2 rounded-full hover:bg-gray-100 transition">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.26 4.26 0 001.88-2.36 8.37 8.37 0 01-2.68 1.03 4.22 4.22 0 00-7.2 3.85 12 12 0 01-8.72-4.42 4.23 4.23 0 001.31 5.63 4.19 4.19 0 01-1.91-.53v.05a4.22 4.22 0 003.39 4.13 4.2 4.2 0 01-1.9.07 4.23 4.23 0 003.94 2.93 8.47 8.47 0 01-5.24 1.8A8.69 8.69 0 013 19.54a12 12 0 006.29 1.84c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.36-.01-.54A8.18 8.18 0 0022.46 6z" />
          </svg>
        </a>
        <a href="#" class="bg-white text-[#BF2D32] p-2 rounded-full hover:bg-gray-100 transition">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M24 4.56v14.91c0 1.05-.85 1.91-1.91 1.91H1.91A1.91 1.91 0 010 19.47V4.56C0 3.5.85 2.65 1.91 2.65h20.18c1.05 0 1.91.85 1.91 1.91zM9.75 19.47h4.5v-7.18h-4.5v7.18zM12 10.56c1.14 0 2.06-.92 2.06-2.06 0-1.14-.92-2.06-2.06-2.06-1.14 0-2.06.92-2.06 2.06 0 1.14.92 2.06 2.06 2.06zM21.09 19.47h-4.5v-3.94c0-.94-.77-1.7-1.7-1.7s-1.7.76-1.7 1.7v3.94h-4.5v-7.18h4.5v.98c.61-.58 1.43-.98 2.34-.98 1.8 0 3.26 1.46 3.26 3.26v3.92z" />
          </svg>
        </a>
        <a href="#" class="bg-white text-[#BF2D32] p-2 rounded-full hover:bg-gray-100 transition">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.75 2C5.67 2 4 3.67 4 5.75v12.5C4 19.33 5.67 21 7.75 21h8.5c2.08 0 3.75-1.67 3.75-3.75V5.75C20 3.67 18.33 2 16.25 2h-8.5zM12 7.5c1.24 0 2.25 1.01 2.25 2.25S13.24 12 12 12 9.75 10.99 9.75 9.75 10.76 7.5 12 7.5zm0 9c2.49 0 4.5-2.01 4.5-4.5h-9c0 2.49 2.01 4.5 4.5 4.5z" />
          </svg>
        </a>
      </div>
      <!-- Social Icons End-->
    </div>

    <!-- About Start -->
    <div class="text-white">
      <h3 class="font-bold mb-4">About</h3>
      <ul class="space-y-3 text-sm">
        <li><a href="#" class="hover:underline">How it works</a></li>
        <li><a href="#" class="hover:underline">Featured</a></li>
        <li><a href="#" class="hover:underline">Partnership</a></li>
        <li><a href="#" class="hover:underline">Business Relation</a></li>
      </ul>
    </div>
    <!-- About End -->

    <!-- Community Start -->
    <div class="text-white">
      <h3 class="font-bold mb-4">Community</h3>
      <ul class="space-y-3 text-sm">
        <li><a href="#" class="hover:underline">Events</a></li>
        <li><a href="#" class="hover:underline">Blog</a></li>
        <li><a href="#" class="hover:underline">Podcast</a></li>
        <li><a href="#" class="hover:underline">Invite a friend</a></li>
      </ul>
    </div>
    <!-- Community End -->

    <!-- Socials Start -->
    <div class="text-white">
      <h3 class="font-bold mb-4">Socials</h3>
      <ul class="space-y-3 text-sm">
        <li><a href="#" class="hover:underline">Discord</a></li>
        <li><a href="#" class="hover:underline">Instagram</a></li>
        <li><a href="#" class="hover:underline">Twitter</a></li>
        <li><a href="#" class="hover:underline">Facebook</a></li>
      </ul>
    </div>
    <!-- Socials End -->
  </div>

  <!-- Bottom Footer -->
  <div class="mt-10 border-t pt-6 text-sm flex flex-col md:flex-row justify-between text-white font-bold">
    <p>©2025 P3K. All rights reserved</p>
    <div class="flex gap-6 mt-4 md:mt-0">
      <a href="#" class="hover:underline">Privacy & Policy</a>
      <a href="#" class="hover:underline">Terms & Condition</a>
    </div>
  </div>
</footer>
<!-- Footer Section End -->

<!-- Scroll to Top Function -->
<script>
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>


<!-- Alpine.js component -->
<script>
  function testimonialSlider() {
    return {
      current: 0,
      total: 3,
      interval: null,
      start() {
        this.interval = setInterval(() => {
          this.next();
        }, 5000);
      },
      next() {
        this.current = (this.current + 1) % this.total;
      },
      prev() {
        this.current = (this.current - 1 + this.total) % this.total;
      },
      goTo(index) {
        this.current = index;
      }
    }
  }
</script>

<!-- Swiper JS -->
<script>
  const swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
</script>

<!-- Animate On Scroll (AOS) -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // animation duration in ms
    once: false,    // allow animation every time the element scrolls into view
  });
</script>

</body>
</html>
