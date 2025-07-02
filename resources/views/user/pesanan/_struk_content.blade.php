<div class="header">
    <div class="title">Struk Pesanan</div>
    <p><strong>Nama:</strong> {{ $pesanan->user->name }}</p>
    <p><strong>Kode Pesanan:</strong> {{ $pesanan->order_id }}</p>
    <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
    <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
    <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesanan->pesananItems as $item)
            <tr>
                <td>{{ $item->menu->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->harga_satuan) }}</td>
                <td>Rp {{ number_format($item->jumlah * $item->harga_satuan) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="text-right"><strong>Total</strong></td>
            <td><strong>Rp {{ number_format($pesanan->total_harga) }}</strong></td>
        </tr>
    </tbody>
</table>
