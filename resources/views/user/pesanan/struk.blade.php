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
                            <th class="border px-4 py-2 text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->pesananItems as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->menu->nama }}</td>
                            <td class="border px-4 py-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->harga_satuan) }}</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($item->jumlah * $item->harga_satuan) }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($pesanan->status === 'paid')
                                    @if($item->rating)
                                        <span>{{ $item->rating }} / 5</span>
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
                                @else
                                    <span class="text-gray-400 italic">Belum tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-semibold">
                            <td colspan="3" class="border px-4 py-2 text-right">Total</td>
                            <td class="border px-4 py-2 text-right">Rp {{ number_format($pesanan->total_harga) }}</td>
                            <td class="border px-4 py-2">
                                @if($pesanan->status === 'paid')
                                    <button type="submit" class="text-blue-600 text-sm underline">Kirim</button>
                                @endif
                                
                            </td>
                        </tr>
                        
                    </tbody>
                    
                </table>
            </form>
            
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
