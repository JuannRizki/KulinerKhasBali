<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Struk Pesanan</div>
        <p>Nama: {{ $pesanan->user->name }}</p>
        <p>Kode Pesanan: {{ $pesanan->order_id }}</p>
        <p>Tanggal: {{ $pesanan->created_at->format('d M Y H:i') }}</p>
        <p>Alamat: {{ $pesanan->alamat }}</p>
        <p>Status: {{ ucfirst($pesanan->status) }}</p>
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
                <td colspan="3" align="right"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($pesanan->total_harga) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
