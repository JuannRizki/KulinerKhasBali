@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Sales Recap</h2>
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Rekap Penjualan</h2>

    {{-- 🔍 Filter Tanggal, Keyword & Status --}}
    <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-wrap items-end gap-4">
    {{-- 🔍 Filter --}}
    <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="start_date" class="block font-semibold text-gray-700">From Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $start }}" class="border border-gray-300 rounded px-4 py-2 w-48">
            <label class="block mb-1 font-semibold">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $start }}" class="w-full border rounded p-2" />
        </div>
        <div>
            <label for="end_date" class="block font-semibold text-gray-700">To Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $end }}" class="border border-gray-300 rounded px-4 py-2 w-48">
            <label class="block mb-1 font-semibold">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $end }}" class="w-full border rounded p-2" />
        </div>
        <div>
            <label for="keyword" class="block font-semibold text-gray-700">Menu Keyword</label>
            <input type="text" name="keyword" id="keyword" value="{{ $keyword ?? '' }}" placeholder="e.g. ayam" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <label for="status" class="block font-semibold text-gray-700">Status</label>
            <select name="status" id="status" class="border border-gray-300 rounded px-4 py-2 w-48">
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All (Paid & Delivered)</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid Only</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered Only</option>
            <label class="block mb-1 font-semibold">Status Pesanan</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="">Semua</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="being_delivered" {{ request('status') == 'being_delivered' ? 'selected' : '' }}>Being Delivered</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-5">
                Filter
            </button>
            <label class="block mb-1 font-semibold">Cari Menu</label>
            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nama menu..." class="w-full border rounded p-2" />
        </div>
        <div class="md:col-span-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
        </div>
    </form>

    {{-- 📈 Chart --}}
    <div class="bg-white rounded-lg shadow p-4 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daily Sales Chart</h3>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    {{-- 🍽️ Pencarian Menu --}}
    <div class="mb-6">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <span class="font-semibold text-green-700">Menu Sales Search:</span>
            @if ($menuYangDicari && $jumlahTerjual > 0)
                <span class="ml-2 text-gray-800">
                    "{{ ucfirst($menuYangDicari) }}" terjual {{ $jumlahTerjual }} kali
                </span>
            @elseif ($menuYangDicari)
                <span class="ml-2 text-gray-500">
                    Tidak ada penjualan untuk menu "{{ ucfirst($menuYangDicari) }}"
                </span>
            @else
                <span class="ml-2 text-gray-500">
                    Masukkan kata kunci untuk melihat penjualan menu tertentu.
                </span>
            @endif
        </div>
    {{-- 💰 Ringkasan --}}
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <p class="text-lg font-semibold">Total Pendapatan: 
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </p>
        @if($menuYangDicari)
            <p>Jumlah terjual untuk <strong>"{{ $menuYangDicari }}"</strong>: {{ $jumlahTerjual }}</p>
        @endif
    </div>

    {{-- 🧾 Tabel Rekap --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
    {{-- 📄 Tabel Rekap Pesanan --}}
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Buyer</th>
                    <th class="px-6 py-3 text-left">Payment</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Menus</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">User</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Menu</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Jumlah</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Total</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
            <tbody class="divide-y divide-gray-100">
                @php
                    $statusLabels = [
                        'paid' => 'Paid',
                        'being_delivered' => 'Delivered',
                    ];
                @endphp

                @forelse ($rekap as $pesanan)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $pesanan->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4">{{ $pesanan->user->name ?? 'User #' . $pesanan->user_id }}</td>
                        <td class="px-6 py-4 capitalize">{{ $pesanan->pembayaran }}</td>
                        <td class="px-6 py-4 font-semibold text-right text-green-600">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($pesanan->items && count($pesanan->items))
                                <ul class="list-disc pl-4">
                                    @foreach ($pesanan->items as $item)
                                        <li>{{ $item->menu->nama ?? '-' }} 
                                            <span class="text-xs text-gray-500">x{{ $item->jumlah }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @foreach ($pesanan->items as $item)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y') }}</td>
                            <td class="px-4 py-2 text-sm">{{ $pesanan->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $item->menu->nama ?? '[Menu Dihapus]' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $item->jumlah }}</td>
                            <td class="px-4 py-2 text-sm">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-sm">{{ $statusLabels[$pesanan->status] ?? ucfirst($pesanan->status) }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-6">No sales data.</td>
                        <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 💰 Total Revenue --}}
    <div class="mt-6 text-right">
        <h3 class="text-xl font-bold text-gray-800">
            Total Revenue:
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </h3>
    {{-- 📈 Chart Penjualan Harian --}}
    <div class="bg-white shadow rounded-lg p-6 mt-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📈 Penjualan Harian</h3>
        <canvas id="dailySalesChart" height="100"></canvas>
    </div>
</div>
@endsection

@section('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Script Chart --}}
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
    const labels = @json($labels);
    const totals = @json($totals);

    const ctx = document.getElementById('dailySalesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            labels: labels,
            datasets: [{
                label: 'Total Sales',
                data: {!! json_encode($totals) !!},
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                label: 'Total Penjualan (Rp)',
                data: totals,
                fill: true,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: '#3B82F6',
                pointBackgroundColor: 'rgb(59, 130, 246)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endsection