<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .image {
            flex: 1.5; /* Perbesar bagian gambar */
            padding: 20px;
        }
        .image img {
            max-width: 100%;
            height: auto;
            width: 350px; /* Ukuran gambar lebih besar */
            border-radius: 10px;
        }
        .text {
            flex: 2;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="image">
        <img src="{{ asset('images/B.webp') }}" alt="Tentang Kami">
    </div>
    <div class="text">
        <h1>Tentang Kami</h1>
        <p>{{ $about }}</p>
    </div>
</div>

</body>
</html>
