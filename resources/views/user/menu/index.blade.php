@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-6">Top-Rated Menu</h2>

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
                        <form action="{{ route('cart.store') }}" method="POST" class="flex flex-col items-center">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="number" name="jumlah" value="1" min="1" class="w-16 text-center mb-2 border rounded">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                            Login untuk Pesan
                        </a>
                    @endauth

                </div>
            </div>
        @endforeach
    </div>

       
    @endif
</div>
@endsection
