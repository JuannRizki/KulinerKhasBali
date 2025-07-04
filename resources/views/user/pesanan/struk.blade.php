@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow-md rounded p-6">
        {{-- Informasi Pesanan --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Struk Pesanan</h2>
            <p><strong>Nama:</strong> {{ $pesanan->user->name }}</p>
            <p><strong>Kode Pesanan:</strong> {{ $pesanan->order_id }}</p>
            <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
            <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}</p>
        </div>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->pesananItems as $item)
                <tr>
                    <td>{{ $item->menu->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->harga_satuan) }}</td>
                    <td>Rp {{ number_format($item->jumlah * $item->harga_satuan) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" align="right"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($pesanan->total_harga) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
