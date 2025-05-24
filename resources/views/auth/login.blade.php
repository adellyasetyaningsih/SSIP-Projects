<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>
<body class="bg-gradient-to-r from-yellow-100 to-yellow-200 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center text-teal-700 mb-6">Student Login</h2>

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.student.submit') }}"class="space-y-4">
            <!-- Form login menggunakan metode POST ke route 'login.student.submit' -->
            @csrf <!-- CSRF token untuk keamanan form -->

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       value="{{ old('email') }}"
                       class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                    class="w-full py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md font-semibold transition">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register.student') }}" class="text-blue-600 hover:underline font-semibold">Register here</a>
        </div>

        <div class="mt-3 text-center">
            <a href="{{ route('login.admin') }}" class="text-sm text-gray-700 hover:text-blue-600 hover:underline font-semibold">
                Login as Admin
            </a>
        </div>
    </div>

</body>
</html>
