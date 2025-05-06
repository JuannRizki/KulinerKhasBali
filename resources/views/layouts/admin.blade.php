<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://unpkg.com/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite CDN -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.7.0/dist/flowbite.min.js"></script>
    
    <!-- Link ke FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-900 text-white">

    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar Section -->
        <div class="w-72 bg-gray-800 h-full p-6 space-y-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-white">Admin Panel</h1>
            </div>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="flex items-center py-2 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-boxes mr-3"></i> Kelola Pesanan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center py-2 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-users mr-3"></i> Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ route('menu.index') }}" class="flex items-center py-2 px-4 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-utensils mr-3"></i> Daftar Menu
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="flex-1 p-8 bg-gray-100 overflow-y-auto">
            <!-- Navbar -->
            <nav class="bg-gray-800 p-4 mb-6 flex justify-between items-center rounded-lg shadow-xl">
                <div class="text-white font-semibold text-xl">Admin Dashboard</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-300 transform hover:scale-105">Logout</button>
                </form>
            </nav>

            <!-- Content Area -->
            @yield('content')
        </div>
    </div>

</body>
</html>
