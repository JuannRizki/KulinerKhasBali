@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
  <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-4">← Back to Home</a>
  <h2 class="text-3xl font-bold mb-6">Your Order List</h2>
</div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($pesanans as $pesanan)
        <div class="card bg-white rounded-lg shadow-lg overflow-hidden">
          <img src="{{ asset('images/' . $pesanan->menu->gambar) }}" class="w-full h-48 object-cover" alt="{{ $pesanan->menu->nama }}">

          <div class="p-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $pesanan->menu->nama }}</h3>
            <p class="text-sm text-gray-600 mt-2">{{ $pesanan->menu->deskripsi }}</p>
            <p class="text-lg font-semibold text-green-600 mt-3">Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 mt-2">Status: {{ $pesanan->status }}</p>

            <!-- Rating -->
            @if($pesanan->status === 'paid') <!-- Only show rating if paid -->
              @if($pesanan->rating === null)
                <form action="{{ route('pesanan.updateRating', $pesanan->id) }}" method="POST" class="mt-4">
                  @csrf
                  @method('PUT')
                  <label for="rating_{{ $pesanan->id }}" class="block text-sm text-gray-700">Beri Rating (1-5)</label>
                  <div class="flex space-x-2">
                    @for ($i = 1; $i <= 5; $i++)
                      <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}_{{ $pesanan->id }}" class="hidden">
                      <label for="star{{ $i }}_{{ $pesanan->id }}" class="cursor-pointer text-xl text-gray-400 hover:text-yellow-500">&#9733;</label>
                    @endfor
                  </div>
                  <button type="submit" class="mt-2 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600">Tambah Rating</button>
                </form>
              @else
                <div class="mt-4">
                  <p class="text-sm font-semibold text-gray-700">Rating: 
                    @for ($i = 0; $i < $pesanan->rating; $i++)
                      <span class="text-yellow-400">&#9733;</span>
                    @endfor
                    @for ($i = $pesanan->rating; $i < 5; $i++)
                      <span class="text-gray-300">&#9734;</span>
                    @endfor
                  </p>
                </div>
              @endif
            @else
              <p class="text-sm text-red-500 mt-3">Harap bayar pesanan terlebih dahulu untuk memberikan rating.</p>
            @endif

            <!-- Hanya tampilkan tombol ini jika pesanan belum dibayar -->
            @if($pesanan->status !== 'paid')
              <!-- Metode Pembayaran -->
              <form action="{{ route('pesanan.pembayaran', $pesanan->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <label for="pembayaran" class="block text-sm text-gray-700">Metode Pembayaran</label>
                <select name="pembayaran" class="w-full p-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                  <option value="" disabled selected>Pilih metode pembayaran</option>
                  <option value="COD">COD (Bayar di tempat)</option>
                
                 
                </select>
                <button type="submit" class="mt-3 w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Simpan Pembayaran</button>
              </form>

              <!-- Batal Pesanan -->
              <form action="{{ route('pesanan.batal', $pesanan->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Batal Pesanan</button>
              </form>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
