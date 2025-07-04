@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Sales Recap</h2>

    {{-- 🔍 Date Filter --}}
    <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap items-end gap-4">
        <div>
            <label for="start_date" class="block font-semibold text-gray-700">From Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $start }}" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <label for="end_date" class="block font-semibold text-gray-700">To Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $end }}" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-5">
                Filter
            </button>
        </div>
    </form>

    {{-- 🍽️ Best Selling Menu --}}
    <div class="mb-6">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <span class="font-semibold text-green-700">Menu Sales Recap:</span>
            @php
                $menuStats = [];
                foreach ($rekap as $pesanan) {
                    if ($pesanan->items) {
                        foreach ($pesanan->items as $item) {
                            $nama = $item->menu->nama ?? '-';
                            if (!isset($menuStats[$nama])) {
                                $menuStats[$nama] = 0;
                            }
                            $menuStats[$nama] += $item->jumlah;
                        }
                    }
                }
                arsort($menuStats); // urutkan dari yang terbanyak
            @endphp
            @if(count($menuStats))
                <ul class="mt-2 ml-2 text-gray-800">
                    @foreach($menuStats as $nama => $jumlah)
                        <li>{{ $nama }} <span class="text-sm text-gray-500">({{ $jumlah }} sold)</span></li>
                    @endforeach
                </ul>
            @else
                <span class="ml-2 text-gray-500">No sales data yet.</span>
            @endif
        </div>
    </div>

    {{-- 🧾 Recap Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Buyer Name</th>
                    <th class="px-6 py-3 text-left">Payment Method</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Menu Bought</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $pesanan)
                <tr class="border-t hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $pesanan->created_at->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $pesanan->user->name ?? 'User #' . $pesanan->user_id }}</td>
                    <td class="px-6 py-4 capitalize">{{ $pesanan->pembayaran }}</td>
                    <td class="px-6 py-4 font-semibold text-right text-green-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($pesanan->items && count($pesanan->items))
                            <ul class="list-disc pl-4">
                                @foreach($pesanan->items as $item)
                                    <li>{{ $item->menu->nama ?? '-' }} <span class="text-xs text-gray-500">x{{ $item->jumlah }}</span></li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6">No sales data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 💰 Total Revenue --}}
    <div class="mt-6 text-right">
        <h3 class="text-xl font-bold text-gray-800">Total Revenue: 
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </h3>
    </div>
</div>
@endsection
