@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 min-h-[60vh]">
  <h2 class="text-2xl font-bold mb-6">My Orders</h2>

  @if($pesanans->isEmpty())
    <p class="text-gray-600">No orders yet.</p>
  @else
    <div class="grid grid-cols-1 gap-4">
      @foreach($pesanans as $pesanan)
        <div class="relative border p-4 rounded shadow bg-white">
          {{-- Cancel button --}}
          @if(in_array($pesanan->status, ['unpaid', 'waiting_verification', 'pending']))
            <form action="{{ route('pesanan.batal', $pesanan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');" class="absolute top-2 right-2">
              @csrf
              <button class="text-red-500 hover:text-red-700 text-xl leading-none" title="Cancel Order">&times;</button>
            </form>
          @endif

          <div class="flex justify-between items-center flex-wrap">
            <div class="mb-2">
              <p><strong>Order Code:</strong> {{ $pesanan->kode ?? 'ORDER-' . $pesanan->id }}</p>
              <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga) }}</p>
              <p><strong>Status:</strong> 
                <span class="font-semibold {{ 
                  $pesanan->status === 'unpaid' ? 'text-red-500' : 
                  ($pesanan->status === 'paid' ? 'text-green-600' : 
                  ($pesanan->status === 'waiting_verification' ? 'text-yellow-500' : 'text-gray-500'))
                }}">
                  {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                </span>
              </p>

              @if($pesanan->status === 'paid')
                <p class="text-green-600 font-medium mt-1">Your order will be delivered to your address.</p>
              @endif

              <p><strong>Date:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="flex flex-col items-end gap-2">
              {{-- Pay --}}
              @if(in_array($pesanan->status, ['unpaid', 'pending']) && $pesanan->snap_token)
                <a href="{{ route('pesanan.bayar', $pesanan->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                  Pay
                </a>
              @endif

              {{-- View detail --}}
              <a href="{{ route('pesanan.detail', $pesanan->id) }}" class="text-sm text-gray-700 underline">
                View Details
              </a>

              {{-- Download Receipt --}}
              @if($pesanan->status === 'paid')
                <a href="{{ route('pesanan.cetakStruk', $pesanan->id) }}" class="text-sm text-green-600 underline">
                  Download Receipt
                </a>
              @endif

            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
