<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-60' : 'w-16'" class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col">
      <!-- Sidebar Header -->
      <div class="flex items-center justify-between p-4">
        <span x-show="sidebarOpen" class="text-xl font-semibold text-indigo-600">Panel</span>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <!-- Profile -->
      <div class="flex flex-col items-center py-4">
        <div class="w-16 h-16 bg-indigo-500 text-white rounded-full flex items-center justify-center text-xl shadow">
          <i class="fas fa-user"></i>
        </div>
        <template x-if="sidebarOpen">
          <div class="text-center mt-2">
            <div class="text-xs text-gray-500">{{ Auth::user()->role ?? 'Administrator' }}</div>
          </div>
        </template>
      </div>

      <!-- Sidebar Menu -->
      <nav class="flex-1 px-2 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-home w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
        </a>
        <a href="{{ route('admin.orders') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-boxes w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Kelola Pesanan</span>
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-users w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Pengguna</span>
        </a>
        <a href="{{ route('admin.menu.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-utensils w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Daftar Menu</span>
        </a>
        <a href="{{ route('admin.contacts') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-envelope w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Kontak</span>
        </a>
        <a href="{{ route('admin.rekap.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-50 transition text-gray-700">
          <i class="fas fa-chart-line w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Rekap Penjualan</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col">
      <!-- Navbar -->
      <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">
        <div></div>
        <div class="flex items-center gap-4">
          <!-- Notifikasi -->
          <button class="text-gray-600 hover:text-indigo-600 transition text-lg">
            <i class="fas fa-bell"></i>
          </button>

          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-gray-600 hover:text-red-600 transition text-lg" title="Logout">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
        </div>
      </header>

      <!-- Halaman Konten -->
      <section class="p-6 overflow-auto">
        @yield('content')
      </section>
    </main>
  </div>
</body>
</html>
