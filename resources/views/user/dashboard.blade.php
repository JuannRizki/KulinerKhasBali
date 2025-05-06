@extends('layouts.app')

@section('content')
<!-- Carousel -->
<div id="carouselExample" class="relative w-full" data-carousel="static">
  <div class="relative h-56 sm:h-72 xl:h-96 overflow-hidden rounded-lg">
    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
      <img src="{{ asset('images/bali1.jpg') }}" class="w-full h-full object-cover" alt="Bali 1">
    </div>
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="{{ asset('images/bali2.jpg') }}" class="w-full h-full object-cover" alt="Bali 2">
    </div>
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="{{ asset('images/bali3.jpg') }}" class="w-full h-full object-cover" alt="Bali 3">
    </div>
  </div>
  <div class="bg-white text-center py-8 rounded-lg shadow">
  <h2 class="text-3xl font-bold text-green-700">Experience the Authentic Taste of Bali!</h2>
  <p class="text-gray-600 mt-2">Discover and order your favorite Balinese cuisine right here.</p>
  <button class="mt-4 px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition">View Menu</button>
  <div class="mt-6">
    <i class="fas fa-arrow-down text-green-600 text-3xl"></i>
  </div>
</div>

  </div>
</div>

<!-- Menu -->
<div class="pt-24 px-4">
  <h2 class="text-2xl font-bold mb-6">Menu yang tersedia</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($menus as $menu)
      <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
        <img src="{{ asset('images/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover">
        <div class="p-4 text-center">
          <h5 class="text-lg font-semibold mb-2">{{ $menu->nama }}</h5>

          {{-- ⭐ Rating --}}
          @if($menu->pesanans_avg_rating > 0)
            <div class="flex justify-center items-center mb-2">
              @for ($i = 1; $i <= 5; $i++)
                @if($i <= floor($menu->pesanans_avg_rating))
                  <span class="text-yellow-400 text-lg">&#9733;</span>
                @else
                  <span class="text-gray-300 text-lg">&#9733;</span>
                @endif
              @endfor
              <span class="ml-2 text-sm text-gray-600">({{ number_format($menu->pesanans_avg_rating, 1) }}/5)</span>
            </div>
          @else
            <p class="text-gray-400 mb-2">Belum ada rating</p>
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
             🛒 Pesan Sekarang
          </a>
          @else
          <a href="{{ route('login') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
            Login untuk Pesan
          </a>
          @endauth
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- Order Modal -->
<x-order-modal />



<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const orderButtons = document.querySelectorAll('.order-btn');
  const orderModal = document.getElementById('orderModal');
  const modalImage = document.getElementById('modalImage');
  const modalTitle = document.getElementById('modalTitle');
  const modalHarga = document.getElementById('modalHarga');
  const jumlahPesanan = document.getElementById('jumlahPesanan');
  const menuId = document.getElementById('menu_id');
  const totalHarga = document.getElementById('total_harga');

  orderButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      orderModal.classList.remove('hidden');
      const nama = button.dataset.nama;
      const gambar = button.dataset.gambar;
      const harga = parseInt(button.dataset.harga);
      const idMenu = button.dataset.id;

      modalImage.src = gambar;
      modalTitle.textContent = nama;
      jumlahPesanan.value = 1;
      modalHarga.textContent = 'Rp. ' + harga.toLocaleString('id-ID');
      menuId.value = idMenu;
      totalHarga.value = harga;

      jumlahPesanan.oninput = () => {
        const quantity = parseInt(jumlahPesanan.value || 1);
        const total = harga * quantity;
        modalHarga.textContent = 'Rp. ' + total.toLocaleString('id-ID');
        totalHarga.value = total;
      };
    });
  });
});
</script>
@endsection
