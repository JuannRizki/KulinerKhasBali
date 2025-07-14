@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📊 Sales Recap</h2>

    {{-- 🔍 Filter Tanggal, Keyword & Status --}}
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
            <label for="keyword" class="block font-semibold text-gray-700">Menu Keyword</label>
            <input type="text" name="keyword" id="keyword" value="{{ $keyword ?? '' }}" placeholder="e.g. ayam" class="border border-gray-300 rounded px-4 py-2 w-48">
        </div>
        <div>
            <label for="status" class="block font-semibold text-gray-700">Status</label>
            <select name="status" id="status" class="border border-gray-300 rounded px-4 py-2 w-48">
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All (Paid & Delivered)</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid Only</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered Only</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-5">
                Filter
            </button>
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
    </div>

    {{-- 🧾 Tabel Rekap --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Buyer</th>
                    <th class="px-6 py-3 text-left">Payment</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Menus</th>
                </tr>
            </thead>
            <tbody>
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
        <h3 class="text-xl font-bold text-gray-800">
            Total Revenue:
            <span class="text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </h3>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Total Sales',
                data: {!! json_encode($totals) !!},
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: '#3B82F6',
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
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
