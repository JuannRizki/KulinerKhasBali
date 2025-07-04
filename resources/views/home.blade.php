@extends('layouts.app')

@section('content')

<!-- Notification for Welcome Message -->
@if(session('welcome'))
  <div id="welcome-alert" style="position:fixed;left:50%;top:90px;transform:translateX(-50%);background:#22c55e;color:#fff;padding:18px 40px;border-radius:10px;z-index:9999;font-size:1.3rem;font-weight:bold;text-align:center;min-width:300px;max-width:95vw;opacity:1;transition:opacity 0.5s;">
    {{ session('welcome') }}
  </div>
  <script>
    setTimeout(function() {
      var alert = document.getElementById('welcome-alert');
      if(alert) {
        alert.style.opacity = '0';
        setTimeout(function() { alert.style.display = 'none'; }, 500);
      }
    }, 3000);
  </script>
@endif

<!-- Carousel -->
<div id="carouselExample" class="relative w-full" data-carousel="static">
  <div class="relative h-56 sm:h-72 xl:h-96 overflow-hidden rounded-lg">
    <!-- Slide 1 -->
    <div class="duration-700 ease-in-out" data-carousel-item="active">
      <img src="{{ asset('images/bg1.jpg') }}" class="w-full h-full object-cover" alt="Bali 1">
    </div>
    <!-- Slide 2 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="{{ asset('images/bg2.jpg') }}" class="w-full h-full object-cover" alt="Bali 2">
    </div>
    <!-- Slide 3 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="{{ asset('images/bg3.jpg') }}" class="w-full h-full object-cover" alt="Bali 3">
    </div>
    <!-- Carousel controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/80 group-hover:bg-white/100 dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/80 group-hover:bg-white/100 dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>

  <!-- Caption Section -->
  <div class="bg-white text-center py-8 rounded-lg shadow mt-6">
    <h2 class="text-3xl font-bold text-green-700">Experience the Authentic Taste of Bali!</h2>
    <p class="text-gray-600 mt-2">Discover and order your favorite Balinese cuisine right here.</p>
    <a href="{{ route('user.menus.index') }}"
       class="mt-4 inline-block px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
      View Menu
    </a>
    <div class="mt-6">
      <i class="fas fa-arrow-down text-green-600 text-3xl"></i>
    </div>
  </div>
</div>

{{-- Include Order Modal jika ingin --}}
{{-- <x-order-modal /> --}}

{{-- Flowbite (jika kamu pakai carousel Flowbite) --}}
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
@endsection
