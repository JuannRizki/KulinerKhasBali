<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
</head>
<body>
    <h2>Kontak Kami</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Anda" required><br><br>
        <input type="email" name="email" placeholder="Email Anda" required><br><br>
        <textarea name="pesan" placeholder="Pesan Anda" rows="4" required></textarea><br><br>
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
