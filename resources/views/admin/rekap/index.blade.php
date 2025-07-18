@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Rekap Penjualan</h2>

    {{-- 🔍 Filter --}}
    <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block mb-1 font-semibold">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $start }}" class="w-full border rounded p-2" />
        </div>
        <div>
            <label class="block mb-1 font-semibold">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $end }}" class="w-full border rounded p-2" />
        </div>
        <div>
            <label class="block mb-1 font-semibold">Status Pesanan</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="">Semua</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="being_delivered" {{ request('status') == 'being_delivered' ? 'selected' : '' }}>Being Delivered</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Cari Menu</label>
            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Nama menu..." class="w-full border rounded p-2" />
        </div>
        <div class="md:col-span-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
        </div>
    </form>

    {{-- 💰 Ringkasan --}}
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <p class="text-lg font-semibold">Total Pendapatan: 
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </p>
        @if($menuYangDicari)
            <p>Jumlah terjual untuk <strong>"{{ $menuYangDicari }}"</strong>: {{ $jumlahTerjual }}</p>
        @endif
    </div>

    {{-- 📄 Tabel Rekap Pesanan --}}
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">User</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Menu</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Jumlah</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Total</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php
                    $statusLabels = [
                        'paid' => 'Paid',
                        'being_delivered' => 'Delivered',
                    ];
                @endphp

                @forelse ($rekap as $pesanan)
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
                        <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 📈 Chart Penjualan Harian --}}
    <div class="bg-white shadow rounded-lg p-6 mt-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">📈 Penjualan Harian</h3>
        <canvas id="dailySalesChart" height="100"></canvas>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Script Chart --}}
<script>
    const labels = @json($labels);
    const totals = @json($totals);

    const ctx = document.getElementById('dailySalesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: totals,
                fill: true,
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: 'rgb(59, 130, 246)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
