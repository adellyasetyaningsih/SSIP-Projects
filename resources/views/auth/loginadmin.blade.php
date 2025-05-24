<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('homepage/Logo P3K.png')}}">

</head>
<body class="bg-gray-100 p-6">
    <div class="flex justify-center items-center min-h-screen">
        <form action="{{ route('login.admin.submit') }}" method="POST" class="w-[26rem] p-6 bg-white rounded-2xl shadow-lg">
            <!-- Form login dikirim ke route 'login.admin.submit' menggunakan metode POST -->
            @csrf
            <input type="hidden" name="login_type" value="admin">

            <h1 class="text-3xl font-bold text-center text-purple-700 mb-4">Admin Login</h1>
            <hr class="mb-5 border-gray-300">

            @if ($errors->has('login'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-400"
                       value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-400">
            </div>

            <div class="mt-5">
                <button type="submit"
                        class="w-full py-2 bg-purple-600 text-white rounded-md hover:bg-purple-800 font-semibold transition">
                    Login as Admin
                </button>
            </div>

            <div class="mt-5 text-center text-sm text-gray-600">
                <a href="{{ route('login.student') }}" class="text-blue-600 hover:underline">← Back to Student Login</a>
            </div>
        </form>
    </div>
</body>
</html>
