@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Pembayaran Pesanan: {{ $pesanan->kode ?? 'ORDER-' . $pesanan->id }}</h2>

    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>

    <button id="pay-button" class="bg-blue-600 text-white px-6 py-2 rounded mt-4 hover:bg-blue-700">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $pesanan->snap_token }}', {
            onSuccess: function(result){
                alert('Pembayaran berhasil!');
                window.location.href = "{{ route('pesanan.index') }}";
            },
            onPending: function(result){
                alert('Pembayaran sedang diproses.');
                window.location.href = "{{ route('pesanan.index') }}";
            },
            onError: function(result){
                alert('Pembayaran gagal.');
            },
            onClose: function(){
                alert('Anda menutup popup pembayaran.');
            }
        });
    });
</script>
@endsection
