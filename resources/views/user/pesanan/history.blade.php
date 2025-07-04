@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 min-h-[60vh]">
  <h2 class="text-2xl font-bold mb-6">My Order History</h2>

  @if($pesanans->isEmpty())
    <p class="text-gray-600">You have no order history yet.</p>
  @else
    <div class="grid grid-cols-1 gap-4">
      @foreach($pesanans as $pesanan)
        <div class="relative border p-4 rounded shadow bg-white">
          <div class="flex justify-between items-center flex-wrap">
            <div class="mb-2">
              <p><strong>Order Code:</strong> {{ $pesanan->kode ?? 'ORDER-' . $pesanan->id }}</p>
              <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga) }}</p>
              <p><strong>Status:</strong> 
                <span class="font-semibold text-green-600">
                  {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                </span>
              </p>
              <p class="text-green-600 font-medium mt-1">Your order has been paid and will be delivered soon.</p>
              <p><strong>Date:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="flex flex-col items-end gap-2">
              {{-- View Details --}}
              <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="text-sm text-gray-700 underline">
                View Details
              </a>

              {{-- Download Receipt --}}
              <a href="{{ route('pesanan.cetakStruk', $pesanan->id) }}" class="text-sm text-green-600 underline">
                Download Receipt
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
