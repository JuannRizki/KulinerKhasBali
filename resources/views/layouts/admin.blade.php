<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Panel')</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AlpineJS -->
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Favicon (optional) -->
  <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-gray-50 text-gray-800">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="bg-white border-r border-gray-200 transition-all duration-300 flex flex-col">
      <!-- Sidebar Header -->
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <span x-show="sidebarOpen" class="text-xl font-bold text-indigo-600">Admin Panel</span>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <!-- Profile (optional) -->
      <div class="flex flex-col items-center py-6 border-b border-gray-200">
        <div class="w-16 h-16 bg-indigo-500 text-white rounded-full flex items-center justify-center text-2xl">
          <i class="fas fa-user"></i>
        </div>
        <template x-if="sidebarOpen">
          <div class="text-center mt-2">
            <p class="text-gray-800 font-semibold">{{ Auth::user()->name ?? 'Admin' }}</p>
            <p class="text-xs text-gray-500">{{ Auth::user()->role ?? 'Administrator' }}</p>
          </div>
        </template>
      </div>

      <!-- Sidebar Menu -->
      <nav class="flex-1 px-2 py-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-home w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
        </a>

        <a href="{{ route('admin.orders') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-box w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Orders</span>
        </a>

        <a href="{{ route('admin.users') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-users w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Users</span>
        </a>

        <a href="{{ route('admin.menu.index') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-utensils w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Menu</span>
        </a>

        <a href="{{ route('admin.contacts') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-envelope w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Contacts</span>
        </a>

        <a href="{{ route('admin.rekap.index') }}" class="flex items-center p-3 rounded hover:bg-indigo-50 transition">
          <i class="fas fa-chart-line w-6 text-center text-indigo-600"></i>
          <span x-show="sidebarOpen" class="ml-3">Sales Recap</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar -->
      <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-bold text-gray-800">@yield('page-title', 'Admin')</h1>
        <div class="flex items-center gap-4">
          <!-- Notification Icon -->
          <button class="text-gray-600 hover:text-indigo-600 transition text-lg">
            <i class="fas fa-bell"></i>
          </button>

          <!-- Logout -->
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-gray-600 hover:text-red-600 transition text-lg" title="Logout">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 overflow-y-auto p-6">
        @yield('content')
      </main>

      <!-- Scripts Slot -->
      @yield('scripts')
    </div>
  </div>
</body>
</html>
