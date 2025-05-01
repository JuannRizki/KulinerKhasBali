@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-6">Struk Pembayaran</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800">{{ $pesanan->menu->nama }}</h3>
        <p class="text-sm text-gray-600 mt-2">Deskripsi: {{ $pesanan->menu->deskripsi }}</p>
        <p class="text-lg font-semibold text-green-600 mt-3">Total Harga: Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">Status Pembayaran: {{ $pesanan->status }}</p>
        <p class="text-sm text-gray-500 mt-2">Metode Pembayaran: {{ $pesanan->pembayaran }}</p>

        <hr class="my-4">

        <p class="text-sm text-gray-500">Tanggal Pembelian: {{ $pesanan->created_at->format('d-m-Y H:i') }}</p>
        <p class="text-sm text-gray-500">No. Pesanan: {{ $pesanan->id }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('pesanan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600">Kembali ke Daftar Pesanan</a>
    </div>
</div>
@endsection
