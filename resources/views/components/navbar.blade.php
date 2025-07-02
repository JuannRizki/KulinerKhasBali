<nav class="bg-green-600 fixed top-0 w-full z-50 shadow">
  <div class="container mx-auto flex items-center justify-between px-4 py-3">
    
    <!-- Logo -->
    <a href="{{ route('home') }}" class="text-white text-xl font-semibold flex items-center gap-2">
      🍽️ Authentic Balinese Cuisine
    </a>

    <!-- Menu Navigasi -->
    <div class="hidden md:flex items-center gap-6">
      <a href="{{ route('dashboard') }}" class="text-white hover:text-green-200">Home</a>
      <a href="{{ route('menu.terbaik') }}" class="text-white hover:text-green-200">Menu</a>
      <a href="{{ route('pesanan.index') }}" class="text-white hover:text-green-200">Payment</a>
      <a href="{{ route('orders.history') }}" class="text-white hover:text-green-200">History</a>
      <a href="{{ route('kontak') }}" class="text-white hover:text-green-200">Contact</a>
    </div>

    <!-- Search + Ikon Keranjang + Dropdown -->
    <div class="flex items-center gap-4">
      
      <!-- Search Form -->
      <form action="{{ route('user.menu.index') }}" method="GET" class="hidden md:flex items-center gap-2">
        <input type="text" name="search" placeholder="Search food..." value="{{ request('search') }}" 
          class="rounded-full px-4 py-2 text-sm focus:outline-none" />
        <button type="submit" class="bg-white text-green-600 rounded-full px-4 py-2 font-semibold text-sm">Search</button>
      </form>

      @auth
      <!-- Ikon Keranjang -->
      <a href="{{ route('cart.index') }}" class="relative inline-flex items-center justify-center text-white hover:text-green-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" 
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-4h-4" />
        </svg>
        <span class="absolute top-0 right-0 inline-block w-4 h-4 text-xs bg-red-600 text-white rounded-full text-center leading-4">
          {{ $cartCount ?? 0 }}
        </span>
      </a>
      @endauth

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
          <li>
            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">
              Profile
            </a>
          </li>
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
