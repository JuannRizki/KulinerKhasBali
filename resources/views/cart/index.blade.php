@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 min-h-[60vh]">
    <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Menu Button --}}
    <div class="mb-4">
        <a href="{{ route('user.menus.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ➕ Add Menu
        </a>
    </div>

    @if ($items->isEmpty())
        <p class="text-gray-600">Your cart is currently empty.</p>
    @else
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-3 px-4">Menu</th>
                    <th class="py-3 px-4">Price</th>
                    <th class="py-3 px-4">Quantity</th>
                    <th class="py-3 px-4">Total</th>
                    <th class="py-3 px-4">Action</th>
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
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Update</button>
                            </form>
                        </td>
                        <td class="py-3 px-4">Rp{{ number_format($total, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-semibold">
                    <td colspan="3" class="py-3 px-4 text-right">Grand Total:</td>
                    <td class="py-3 px-4">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        {{-- Checkout Form --}}
        <form action="{{ route('pesanan.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <label class="block">
                <span class="text-gray-700">Shipping Address</span>
                <textarea name="alamat" required class="w-full mt-1 border rounded px-3 py-2" rows="3" placeholder="Enter your complete shipping address...">{{ Auth::user()->alamat }}</textarea>
            </label>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                🧾 Place Order Now
            </button>
        </form>
    @endif
</div>
@endsection
