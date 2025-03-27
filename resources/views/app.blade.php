<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
</head>
<body>
    <header>
        <h1>Header Aplikasi</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Aplikasi Laravel</p>
    </footer>
</body>
</html>
