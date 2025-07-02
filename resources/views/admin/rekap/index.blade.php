@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Rekap Penjualan</h2>

    {{-- 🔍 Filter Tanggal --}}
    <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap items-end gap-4">
        <div>
            <label for="start_date" class="block font-semibold text-gray-700">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" value="{{ $start }}" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <label for="end_date" class="block font-semibold text-gray-700">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" value="{{ $end }}" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-5">
                Filter
            </button>
        </div>
    </form>

    {{-- 🧾 Tabel Rekap --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Nama Pembeli</th>
                    <th class="px-6 py-3 text-left">Metode Pembayaran</th>
                    <th class="px-6 py-3 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $pesanan)
                <tr class="border-t hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $pesanan->created_at->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $pesanan->user->name ?? 'User #' . $pesanan->user_id }}</td>
                    <td class="px-6 py-4 capitalize">{{ $pesanan->pembayaran }}</td>
                    <td class="px-6 py-4 font-semibold text-right text-green-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-6">Tidak ada data penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 💰 Total Pendapatan --}}
    <div class="mt-6 text-right">
        <h3 class="text-xl font-bold text-gray-800">Total Pendapatan: 
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </h3>
    </div>
</div>
@endsection
