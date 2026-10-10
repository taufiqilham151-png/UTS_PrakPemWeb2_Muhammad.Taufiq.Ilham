<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog Buku')</title>
</head>
<body>
    <nav>
        <a href="{{ route('books.index') }}">Data Buku</a>
    </nav>

    <main>
        @yield('content')
    </main>
    @if (session('success'))
    <div class="alert success">
        {{ session('success') }}
    </div>
    @endif
</body>
</html>
