@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-screen-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📦 Orders List</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-6 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-6 rounded-lg shadow-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Makanan</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Alamat</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Pembayaran</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t hover:bg-gray-100 transition-all duration-200">
                    <td class="px-6 py-4 text-gray-800">{{ $order->id }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->user->name ?? 'User #' . $order->user_id }}</td>
                    <td class="px-6 py-4 text-gray-800">
                        @if($order->pesananItems && count($order->pesananItems))
                            <ul class="list-disc pl-4">
                                @foreach($order->pesananItems as $item)
                                    <li>{{ $item->menu->nama }} <span class="text-gray-500">x{{ $item->jumlah }}</span></li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->alamat }}</td>
                    <td class="px-6 py-4 text-gray-800">
                        @switch($order->status)
                            @case('waiting_verification')
                                <span class="text-orange-500 font-semibold">Waiting Verification</span>
                                @break
                            @case('unpaid')
                                <span class="text-red-600 font-semibold">Unpaid</span>
                                @break
                            @case('paid')
                                <span class="text-green-600 font-semibold">Paid</span>
                                @break
                            @case('being_delivered')
                                <span class="text-yellow-600 font-semibold">Being Delivered</span>
                                @break
                            @default
                                <span class="text-gray-600">{{ ucfirst($order->status) }}</span>
                        @endswitch
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ ucfirst($order->pembayaran ?? '-') }}</td>
                    <td class="px-6 py-4 space-y-2">

                        {{-- ✅ Verifikasi Manual --}}
                        @if($order->status === 'waiting_verification')
                        <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 w-full">
                                Approve Manually
                            </button>
                        </form>
                        @endif

                        {{-- ✅ Tandai Lunas (untuk unpaid + midtrans) --}}
                        @if($order->status === 'unpaid' && $order->pembayaran === 'midtrans')
                        <form action="{{ route('admin.orders.markPaid', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-full">
                                Mark as Paid
                            </button>
                        </form>
                        @endif

                        {{-- ✅ Tandai Dikirim --}}
                        @if($order->status === 'paid')
                        <form action="{{ route('admin.orders.markDelivered', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 w-full">
                                Mark as Delivered
                            </button>
                        </form>
                        @endif

                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
