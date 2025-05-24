<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>P3K Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>

<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow-sm">
  <div class="flex items-center justify-between px-4 md:px-8 py-3">
    
    <!-- Hamburger Menu (mobile only) di kiri -->
    <button id="sidebarToggle" class="md:hidden text-gray-700 focus:outline-none mr-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Logo -->
    <div class="flex items-center space-x-2 flex-1">
      <img src="{{ asset('homepage/Logo P3K.png') }}" alt="P3K Logo" class="h-12 md:h-14 object-contain">
    </div>

    <!-- User + Logout -->
    <form action="{{ route('logout')}}" method="POST" class="ml-auto">
      @csrf
      <button type="submit" class="bg-[#486284] text-white px-4 py-2 rounded-full text-sm hover:bg-blue-800 transition">
        Logout
      </button>
    </form>
  </div>
</header>


    <!-- Main Layout -->
    <div class="flex flex-1 flex-col md:flex-row">

       <!-- Sidebar Start -->
<aside id="sidebar" class="w-full md:w-64 bg-yellow-400 px-6 py-8 flex-shrink-0 hidden md:block">
    <div class="space-y-10">
        <!-- Core Section -->
        <div>
            <h2 class="text-xs font-semibold uppercase mb-4">Core</h2>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-black font-bold hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Interface Section -->
        <div>
            <h2 class="text-xs font-semibold uppercase mb-4">Interface</h2>

            <!-- Students Data -->
            <div class="space-y-2">
                <a href="{{ route('admin.students.index') }}" class="flex items-center justify-between text-black font-bold hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-6 8h6a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h2z" />
                        </svg>
                        <span>Students Data</span>
                    </div>
                </a>
            </div>

            <!-- Category + Subject -->
            <div class="space-y-2 mt-4">
                <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between text-black font-bold hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20l9-5-9-5-9 5 9 5zm0-15v10" />
                        </svg>
                        <span>Category + Subject</span>
                    </div>
                </a>
            </div>

             <!-- Timeslot -->
             <div class="space-y-2 mt-4">
                <a href="{{ route('admin.timeslots.index') }}" class="flex items-center justify-between text-black font-bold hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Timeslot</span>
                    </div>
                </a>
            </div>

            <!-- Teacher -->
            <div class="space-y-2 mt-4">
                <a href="{{ route('admin.teachers.index') }}" class="flex items-center justify-between text-black font-bold hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H9m3 0h3" />
                        </svg>
                        <span>Teacher</span>
                    </div>
                </a>
            </div>

            <!-- Admin -->
            <div class="space-y-2 mt-4">
                <a href="{{ route('admin.admins.index') }}" class="flex items-center justify-between text-black font-bold hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Admin</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</aside>
<!-- Sidebar End -->

        <!-- Main Area -->
        <main class="flex-1 p-4 md:p-6 bg-gray-100 overflow-auto">
            <div class="bg-white rounded shadow p-4 md:p-6">
            @yield('content')
               
            </div>
        </main>
    </div>

   <!-- Footer Start -->
   <footer class="bg-[#BF2D32] text-white ">
    <div class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-4 gap-10">
      <!-- Optional Footer content -->
    </div>
    <div class="text-center text-sm py-4 border-t border-white border-opacity-20">
      ©2025 P3K. All rights reserved |
      <a href="#" class="underline">Privacy & Policy</a> |
      <a href="#" class="underline">Terms & Conditions</a>
    </div>
  </footer>
  <!-- Footer End -->

    <!-- Scripts -->
    <script>
        // Sidebar toggle for mobile
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Search filter
        const searchInput = document.getElementById('subjectSearch');
        const subjectRows = document.querySelectorAll('#dashboardTable tbody tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();
            subjectRows.forEach(row => {
                const rowText = row.innerText.toLowerCase();
                row.style.display = rowText.includes(query) ? '' : 'none';
            });
        });

    </script>
</body>

</html>
