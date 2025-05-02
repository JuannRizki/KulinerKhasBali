<<<<<<< HEAD
@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-4">
        <i class="fas fa-tachometer-alt mr-2 text-gray-700"></i> Dashboard
    </h2>
    <hr class="mb-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Kuliner -->
        <div class="bg-blue-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-utensils mr-2"></i> Kuliner
            </h3>
            <p class="text-3xl font-bold">{{ $totalMenus }}</p>
        </div>

        <!-- Tamu -->
        <div class="bg-green-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-users mr-2"></i> Tamu
            </h3>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>

        <!-- Pesanan -->
        <div class="bg-yellow-200 text-gray-800 rounded-xl p-6 shadow hover:shadow-lg hover:scale-105 transition">
            <h3 class="text-xl font-semibold mb-2 flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i> Pesanan
            </h3>
            <p class="text-3xl font-bold">{{ $totalPesanans }}</p>
=======
<!DOCTYPE html>
<html lang="en">
<head>
@auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}">
    @endif
@endauth

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">Admin Panel</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-sm bg-red-500 px-3 py-1 rounded">Logout</button>
            </form>
>>>>>>> f1eb59171ad931d734f3ee2a2f0898af39f106b2
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="hidden lg:block w-64 bg-white shadow-md h-screen p-4">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 hover:bg-gray-200">Dashboard</a></li>
                <li><a href="#" class="block py-2 hover:bg-gray-200">Kelola Pesanan</a></li>
                <li><a href="#" class="block py-2 hover:bg-gray-200">Pengguna</a></li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
<<<<<<< HEAD
</div>
@endsection
=======
</body>
</html>
>>>>>>> f1eb59171ad931d734f3ee2a2f0898af39f106b2
