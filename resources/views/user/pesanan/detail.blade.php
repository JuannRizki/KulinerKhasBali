@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Detail Pesanan</h2>

    <div class="bg-white p-4 shadow rounded">
        <p><strong>Kode Pesanan:</strong> {{ $pesanan->kode ?? 'ORDER-' . $pesanan->id }}</p>
        <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}</p>
        <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
        <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>

        <h4 class="mt-4 font-semibold">Daftar Item:</h4>
        <ul class="list-disc pl-6">
            @foreach($pesanan->items as $item)
                <li>
                    {{ $item->menu->nama }} x {{ $item->jumlah }} — 
                    Rp {{ number_format($item->menu->harga * $item->jumlah) }}
                </li>
            @endforeach
        </ul>

        <p class="mt-4"><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga) }}</p>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('pesanan.index') }}" class="text-blue-600 underline">← Kembali ke Pesanan</a>
            <a href="{{ route('pesanan.detail', $pesanan->id) }}?download=true" class="text-green-600 underline">Download Struk PDF</a>
        </div>
    </div>
</div>
@endsection
