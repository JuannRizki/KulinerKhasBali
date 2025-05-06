@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pesanan</h2>

    <!-- Menampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-6 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Daftar Pesanan -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Menu ID</th>
                    <th class="px-6 py-3 text-left">User ID</th>
                    <th class="px-6 py-3 text-left">Total Harga</th>
                    <th class="px-6 py-3 text-left">Alamat</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Pembayaran</th>
                    <th class="px-6 py-3 text-left">Status Pembayaran</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t hover:bg-gray-100 transition-all duration-200">
                    <td class="px-6 py-4 text-gray-800">{{ $order->id }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->menu_id }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->user_id }}</td>
                    <td class="px-6 py-4 text-gray-800">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->alamat }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->status }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->pembayaran }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->status_pembayaran }}</td>
                    <td class="px-6 py-4">
                        <!-- Form untuk menghapus pesanan -->
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all duration-200">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
