@extends('layouts.app')

@section('content')
  <!-- Slider Gambar (Flowbite Carousel) -->
  <div id="carouselExample" class="relative w-full" data-carousel="static">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 sm:h-72 xl:h-96 overflow-hidden rounded-lg">
      <!-- Slide 1 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
        <img src="{{ asset('images/bali1.jpg') }}" class="w-full h-full object-cover" alt="Bali 1">
      </div>
      <!-- Slide 2 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="{{ asset('images/bali2.jpg') }}" class="w-full h-full object-cover" alt="Bali 2">
      </div>
      <!-- Slide 3 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="{{ asset('images/bali3.jpg') }}" class="w-full h-full object-cover" alt="Bali 3">
      </div>
    </div>

    <!-- Navigasi -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-8 h-8 bg-white/30 group-hover:bg-white/50 rounded-full">
        <svg aria-hidden="true" class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
      </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-8 h-8 bg-white/30 group-hover:bg-white/50 rounded-full">
        <svg aria-hidden="true" class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
      </span>
    </button>
  </div>

  <!-- Judul -->
  <h2 class="text-2xl font-bold my-6 px-4">Menu yang tersedia</h2>

  <!-- Daftar Menu -->
  <div class="px-4 pb-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($menus as $menu)
      <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
        <img src="{{ asset('images/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
        <div class="p-4 text-center">
          <h5 class="text-lg font-semibold mb-2">{{ $menu->nama }}</h5>

          @if($menu->average_rating > 0)
            <p class="text-yellow-500 mb-2">⭐ {{ $menu->average_rating }} / 5</p>
          @else
          
          @endif

          <p class="text-gray-500 mb-2">{{ $menu->deskripsi }}</p>
          <p class="text-green-600 font-bold mb-4">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</p>

          @auth
            <a href="#" 
               class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm order-btn"
               data-nama="{{ $menu->nama }}"
               data-gambar="{{ asset('images/' . $menu->gambar) }}"
               data-harga="{{ $menu->harga }}"
               data-id="{{ $menu->id }}">
               🛒 Order Now
            </a>
          @else
            <a href="{{ route('login') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
              Login untuk Order
            </a>
          @endauth
        </div>
      </div>
    @endforeach
  </div>

  <!-- Script Flowbite -->
  <script src="{{ asset('js/flowbite.min.js') }}"></script>
@endsection
