@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
  <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-4">← Back to Home</a>
  <h2 class="text-3xl font-bold mb-6">Your Order History</h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6">
  @forelse($orders as $order)
    <div class="card bg-white rounded-lg shadow-lg overflow-hidden">
      @if($order->menu && $order->menu->gambar)
        <img src="{{ asset('images/' . $order->menu->gambar) }}" class="w-full h-48 object-cover" alt="{{ $order->menu->nama }}">
      @else
        <p class="p-4 text-red-500">Gambar tidak tersedia</p>
      @endif

      <div class="p-4">
        <h3 class="text-xl font-semibold text-gray-800">{{ $order->menu ? $order->menu->nama : 'Menu tidak ditemukan' }}</h3>
        <p class="text-sm text-gray-600 mt-2">{{ $order->menu ? $order->menu->deskripsi : 'Deskripsi tidak tersedia' }}</p>
        <p class="text-lg font-semibold text-green-600 mt-3">Rp. {{ number_format($order->total_harga ?? ($order->menu->harga ?? 0), 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">Status: {{ ucfirst($order->status) }}</p>

        @if($order->status === 'paid')
          <a href="{{ route('pembayaran.detail', $order->id) }}" 
             class="inline-block mt-3 w-full bg-blue-500 text-white py-2 rounded-lg text-center hover:bg-blue-600">
             Lihat Detail Pembayaran
          </a>
        @endif

        <form action="{{ route('orders.history.destroy', $order->id) }}" method="POST" class="mt-4"
          onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
            Hapus Pesanan
          </button>
        </form>
      </div>
    </div>
  @empty
    <p class="text-gray-600 px-6">Belum ada riwayat pesanan.</p>
  @endforelse
</div>
@endsection
