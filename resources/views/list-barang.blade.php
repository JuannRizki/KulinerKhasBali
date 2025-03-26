<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
</head>
<body>
    <h1>Daftar Barang</h1>
    <ul>
        @foreach ($data as $barang)
            <li>{{ $barang['nama'] }} - Rp{{ number_format($barang['harga'], 0, ',', '.') }}</li>
        @endforeach
    </ul>
</body>
</html>
