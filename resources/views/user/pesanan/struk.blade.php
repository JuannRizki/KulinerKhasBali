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

        {{-- Tabel Pesanan --}}
        <div class="overflow-x-auto">
            <form action="{{ route('pesanan.rating', $pesanan->id) }}" method="POST">
                @csrf
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Menu</th>
                            <th class="border px-4 py-2 text-center">Jumlah</th>
                            <th class="border px-4 py-2 text-right">Harga Satuan</th>
                            <th class="border px-4 py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->pesananItems as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->menu->nama }}</td>
                            <td class="border px-4 py-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->harga_satuan) }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->jumlah * $item->harga_satuan) }}</td>
                        </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-semibold">
                            <td colspan="2" class="border px-4 py-2 text-right">Total</td>
                            <td colspan="2" class="border px-4 py-2 text-right">Rp {{ number_format($pesanan->total_harga) }}</td>
                        </tr>
                    </tbody>
                </table>
            </form>

            {{-- Kotak Rating Menu --}}
            @if($pesanan->status === 'paid')
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Beri Rating Menu</h3>
                <form action="{{ route('pesanan.rating', $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($pesanan->pesananItems as $item)
                        <div class="border rounded-lg p-4 flex flex-col items-center bg-gray-50">
                            @if($item->menu->gambar)
                                <img src="{{ asset('images/' . $item->menu->gambar) }}" alt="{{ $item->menu->nama }}" class="w-24 h-24 object-cover rounded mb-2">
                            @endif
                            <div class="font-semibold mb-1">{{ $item->menu->nama }}</div>
                            <div class="mb-2 text-sm text-gray-500">x{{ $item->jumlah }}</div>
                            @if($item->rating)
                                <div class="text-yellow-500 font-bold">{{ $item->rating }} / 5</div>
                            @else
                                <select name="ratings[{{ $item->id }}]" class="text-sm border rounded px-2 py-1">
                                    <option value="">-</option>
                                    <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                                    <option value="4">⭐️⭐️⭐️⭐️</option>
                                    <option value="3">⭐️⭐️⭐️</option>
                                    <option value="2">⭐️⭐️</option>
                                    <option value="1">⭐️</option>
                                </select>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Rating</button>
                    </div>
                </form>
            </div>
            @endif

              {{-- Download Struk --}}
              @if($pesanan->status === 'paid')
                <a href="{{ route('pesanan.cetakStruk', $pesanan->id) }}" class="text-sm text-green-600 underline">
                  Download Struk
                </a>
              @endif
        </div>
    </div>
</div>
@endsection
