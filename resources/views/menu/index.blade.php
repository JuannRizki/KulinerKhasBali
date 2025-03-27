<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Khas Bali</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Kuliner Khas Bali</h1>
        <form action="{{ route('menu.search') }}" method="GET" class="mb-4">
    <input type="text" name="q" placeholder="Cari makanan..." class="border p-2 rounded">
    <button type="submit" class="bg-green-500 text-white p-2 rounded">Search</button>
</form>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($menu as $item)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <img src="{{ asset('images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-xl font-bold mt-2">{{ $item['nama'] }}</h2>
                    <p class="text-gray-600">Asal: {{ $item['asal'] }}</p>
                    <p class="text-gray-700 mt-1">{{ $item['deskripsi'] }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-500 text-lg">★★★★★</span>
                    </div>
                    <button class="bg-yellow-400 text-white font-bold py-1 px-3 rounded mt-2">RATING</button>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
