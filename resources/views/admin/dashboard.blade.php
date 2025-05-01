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
</body>
</html>
