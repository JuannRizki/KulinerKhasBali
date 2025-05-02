@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-6">Pesanan yang Sudah Dibayar</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pesanans as $pesanan)
        <div class="card bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="{{ asset('images/' . $pesanan->menu->gambar) }}" class="w-full h-48 object-cover" alt="{{ $pesanan->menu->nama }}">
            <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800">{{ $pesanan->menu->nama }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $pesanan->menu->deskripsi }}</p>
                <p class="text-lg font-semibold text-green-600 mt-3">Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-2">Status: {{ $pesanan->status }}</p>

                <!-- Tombol Detail -->
                <a href="{{ route('pembayaran.detail', $pesanan->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Detail</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
