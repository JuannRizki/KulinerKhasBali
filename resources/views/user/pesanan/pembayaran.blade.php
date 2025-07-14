@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 min-h-[60vh] flex justify-center items-center">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full border border-gray-200">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">
            Order Payment: {{ $pesanan->order_id ?? 'ORDER-' . $pesanan->id }}
        </h2>
        <div class="mb-6 flex flex-col gap-2 text-center">
            <div>
                <span class="font-semibold">Total:</span>
                <span class="text-lg text-blue-700 font-bold">Rp {{ number_format($pesanan->total_harga) }}</span>
            </div>
            <div>
                <span class="font-semibold">Status:</span>
                <span class="capitalize">{{ $pesanan->status }}</span>
            </div>
        </div>
        <button id="pay-button" class="bg-blue-600 text-white px-6 py-2 rounded-lg w-full font-semibold text-lg shadow hover:bg-blue-700 transition">
            Pay Now
        </button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $pesanan->snap_token }}', {
            onSuccess: function(result){
                // AJAX POST to markPaid endpoint
                fetch("{{ route('pesanan.markPaid', $pesanan->id) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .finally(() => {
                    alert('Payment successful!');
                    window.location.href = "{{ route('orders.history') }}";
                });
            },
            onPending: function(result){
                alert('Your payment is being processed.');
                window.location.href = "{{ route('pesanan.index') }}";
            },
            onError: function(result){
                alert('Payment failed.');
            },
            onClose: function(){
                alert('You closed the payment popup.');
            }
        });
    });
</script>
@endsection
