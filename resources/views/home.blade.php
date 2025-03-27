<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fooder - Kuliner Khas Bali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #28a745;
            color: white;
            position: fixed;
            padding: 20px;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>FOODER</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">🏠 Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white">📋 Pesanan</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white">💳 Pembayaran</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white">📞 Kontak</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white">❤️ Favorite</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Menu yang tersedia</h2>
            <form action="{{ route('home') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari makanan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>

        <div class="row mt-3">
            @foreach($menus as $menu)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <!-- Pastikan gambar ditampilkan dengan benar -->
                        <img src="{{ asset('images/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}">

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $menu->nama }}</h5>
                            <p class="card-text">{{ $menu->deskripsi }}</p>
                            <p class="fw-bold">Rp.{{ number_format($menu->harga, 0, ',', '.') }}</p>
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
