@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 min-h-[60vh]">
    <h2 class="text-2xl font-bold mb-6">Keranjang Anda</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($items->isEmpty())
        <p class="text-gray-600">Keranjang kamu masih kosong.</p>
    @else
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-3 px-4">Menu</th>
                    <th class="py-3 px-4">Harga</th>
                    <th class="py-3 px-4">Jumlah</th>
                    <th class="py-3 px-4">Total</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($items as $item)
                    @php
                        $total = $item->menu->harga * $item->jumlah;
                        $grandTotal += $total;
                    @endphp
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $item->menu->nama }}</td>
                        <td class="py-3 px-4">Rp{{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Ubah</button>
                            </form>
                        </td>
                        <td class="py-3 px-4">Rp{{ number_format($total, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-semibold">
                    <td colspan="3" class="py-3 px-4 text-right">Total Keseluruhan:</td>
                    <td class="py-3 px-4">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        {{-- Tombol Checkout --}}
      <form action="{{ route('pesanan.store') }}" method="POST" class="mt-4 space-y-4">
    @csrf
    <label class="block">
        <span class="text-gray-700">Alamat Pengiriman</span>
        <textarea name="alamat" required class="w-full mt-1 border rounded px-3 py-2" rows="3" placeholder="Masukkan alamat lengkap pengiriman..."></textarea>
    </label>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        🧾 Buat Pesanan Sekarang
    </button>
</form>

    @endif
</div>
@endsection
