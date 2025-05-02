<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-green-600 fixed top-0 w-full z-50 shadow">
  <div class="container mx-auto flex items-center justify-between px-4 py-3">
    <!-- Logo -->
    <a href="#" class="text-white text-xl font-semibold flex items-center gap-2">
      🍽️ Kuliner khas Bali
    </a>
    <!-- Menu Navigasi -->
    <div class="hidden md:flex items-center gap-6">
      <a href="{{ route('dashboard') }}" class="text-white hover:text-green-200">Dashboard</a>
      <a href="{{ route('pesanan.index') }}" class="text-white hover:text-green-200">Pesanan</a>
      <a href="{{ route('pembayaran.index') }}" class="text-white hover:text-green-200">Pembayaran</a>
      <a href="{{ route('kontak') }}" class="text-white hover:text-green-200">Kontak</a>

      <a href="#" class="text-white hover:text-green-200">Favorite</a>
    </div>
    <!-- Search + User Dropdown -->
    <div class="flex items-center gap-4">
      <!-- Form Search -->
      <form action="{{ route('dashboard') }}" method="GET" class="hidden md:flex items-center gap-2">
        <input type="text" name="search" placeholder="Cari makanan..." value="{{ request('search') }}" class="rounded-full px-4 py-2 text-sm focus:outline-none">
        <button type="submit" class="bg-white text-green-600 rounded-full px-4 py-2 font-semibold text-sm">Search</button>
      </form>
      <!-- User Dropdown -->
      @auth
      <div class="relative group">
        <button class="text-white font-medium flex items-center gap-1">
          {{ Auth::user()->name }}
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
          </svg>
        </button>
        <ul class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden group-hover:block z-10">
          <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">Profile</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
            </form>
          </li>
        </ul>
      </div>
      @endauth
    </div>
  </div>
</nav>
