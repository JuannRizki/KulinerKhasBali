@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow-md rounded p-6">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Order Info --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold mb-2">Order Receipt</h2>
            <p><strong>Name:</strong> {{ $pesanan->user->name }}</p>
            <p><strong>Order Code:</strong> {{ $pesanan->order_id }}</p>
            <p><strong>Date:</strong> {{ $pesanan->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</p>
            <p><strong>Address:</strong> {{ $pesanan->alamat }}</p>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}</p>
        </div>

        {{-- Order Table --}}
        <div class="overflow-x-auto">
            <table class="w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Menu</th>
                        <th class="border px-4 py-2 text-center">Quantity</th>
                        <th class="border px-4 py-2 text-right">Unit Price</th>
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
        </div>

        {{-- Rating Section --}}
        @if(in_array($pesanan->status, ['paid', 'being_delivered']))
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Rate the Menu</h3>
                <form action="{{ route('pesanan.rating', $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($pesanan->pesananItems as $item)
                            <div 
                              class="w-full flex flex-col items-center text-center 
                              rounded-2xl p-6 bg-white shadow-md hover:shadow-lg transition 
                              border border-gray-200 hover:-translate-y-1 transform duration-200"
                            >
                                @if($item->menu->gambar)
                                    <img 
                                      src="{{ asset('images/' . $item->menu->gambar) }}" 
                                      alt="{{ $item->menu->nama }}" 
                                      class="w-24 h-24 object-cover mb-4 border border-gray-200 shadow-sm rounded-md"
                                    >
                                @endif

                                <div class="font-bold text-gray-800 text-lg mb-1">{{ $item->menu->nama }}</div>
                                <div class="text-sm text-gray-500 mb-3">Qty: x{{ $item->jumlah }}</div>

                                @if($item->rating)
                                    <div class="text-yellow-500 font-semibold">{{ $item->rating }} / 5</div>
                                @else
                                    {{-- Star Rating Component --}}
                                    <div 
                                        x-data="{ rating: 0, hoverRating: 0 }" 
                                        class="flex space-x-1 justify-center"
                                    >
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg 
                                              xmlns="http://www.w3.org/2000/svg"
                                              class="w-8 h-8 cursor-pointer transition-colors duration-200"
                                              viewBox="0 0 20 20"
                                              fill="currentColor"
                                              :class="{
                                                'text-yellow-400': hoverRating >= {{ $i }} || (!hoverRating && rating >= {{ $i }}),
                                                'text-gray-300': hoverRating < {{ $i }} && rating < {{ $i }}
                                              }"
                                              @mouseenter="hoverRating = {{ $i }}"
                                              @mouseleave="hoverRating = 0"
                                              @click="rating = {{ $i }}"
                                            >
                                              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.968a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.286 3.969c.3.92-.755 1.688-1.54 1.118l-3.389-2.46a1 1 0 00-1.176 0l-3.388 2.46c-.785.57-1.84-.197-1.54-1.118l1.286-3.969a1 1 0 00-.364-1.118L2.37 9.395c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.968z"/>
                                            </svg>
                                        @endfor
                                        <input type="hidden" name="ratings[{{ $item->id }}]" x-model="rating">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Submit Rating
                        </button>
                    </div>
                </form>
            </div>

            {{-- Download Receipt --}}
            <a href="{{ route('pesanan.cetakStruk', $pesanan->id) }}" 
                class="inline-block mt-6 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Download Receipt
            </a>
        @endif

    </div>
</div>
@endsection