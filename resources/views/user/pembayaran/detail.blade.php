@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-3xl font-bold mb-6">Payment Receipt</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800">{{ $pesanan->menu->nama }}</h3>
        <p class="text-sm text-gray-600 mt-2">Description: {{ $pesanan->menu->deskripsi }}</p>
        <p class="text-lg font-semibold text-green-600 mt-3">Total Price: Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-2">Payment Status: {{ $pesanan->status }}</p>
        <p class="text-sm text-gray-500 mt-2">Payment Method: {{ $pesanan->pembayaran }}</p>

        <hr class="my-4">

        <p class="text-sm text-gray-500">Purchase Date: {{ $pesanan->created_at->format('d-m-Y H:i') }}</p>
        <p class="text-sm text-gray-500">Order No: {{ $pesanan->id }}</p>

        <!-- Delivery Address -->
        <p class="text-sm text-gray-500 mt-4">Delivery Address: {{ $pesanan->alamat }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('pesanan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600">Back to Orders</a>
    </div>
</div>
@endsection
