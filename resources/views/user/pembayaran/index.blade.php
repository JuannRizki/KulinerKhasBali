@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Pembayaran Pesanan #{{ $pesanan->id }}</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded shadow mb-6">
        <p><strong>Menu:</strong> {{ $pesanan->menu->nama }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p><strong>Alamat Pengiriman:</strong> {{ $pesanan->alamat }}</p>
        <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>
        <p><strong>Batas Waktu Pembayaran:</strong> {{ $pesanan->expired_at->format('d M Y H:i') }}</p>
    </div>

    <form action="{{ route('pesanan.pembayaran', $pesanan->id) }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        @method('PUT')

        <label for="pembayaran" class="block font-medium mb-2">Metode Pembayaran</label>
        <select name="pembayaran" id="pembayaran" class="border rounded w-full p-2 mb-4" required>
            <option value="">-- Pilih Metode --</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="QRIS">QRIS</option>
            <option value="Cash">Cash</option>
        </select>

        @error('pembayaran')
            <p class="text-red-600 mb-2">{{ $message }}</p>
        @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Bayar Sekarang
        </button>
    </form>

    <a href="{{ route('pesanan.index') }}" class="inline-block mt-4 text-gray-600 hover:text-gray-900">Kembali ke Daftar Pesanan</a>
</div>
@endsection
