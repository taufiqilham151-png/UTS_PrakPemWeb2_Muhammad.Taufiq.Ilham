<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - {{ $book->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 30px;
        }
        .card {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 24px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
        .info-group {
            margin-bottom: 12px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="title">{{ $book->title }}</div>

    <div class="info-group">
        <span class="label">Penulis:</span> {{ $book->author }}
    </div>

    <div class="info-group">
        <span class="label">Tahun Terbit:</span> {{ $book->publication_year ?? $book->year ?? '-' }}
    </div>

    <div class="info-group">
        <span class="label">Deskripsi:</span>
        <p>{{ $book->description ?? 'Deskripsi tidak tersedia untuk buku ini.' }}</p>
    </div>

    <a href="{{ route('books.edit', $book->id) }}" style="padding: 8px 16px; background-color: #ffc107; color: black; text-decoration: none; border-radius: 4px; margin-left: 5px;">Edit Buku</a>
    <a href="/books" class="btn-back">&laquo; Kembali ke Data Buku</a>
</div>

</body>
</html>
{{-- @extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h1>{{ $book->title }}</h1>
    <dl>
        <dt>ISBN</dt>
        <dd>{{ $book->isbn ?: '-' }}</dd>
        <dt>Penulis</dt>
        <dd>{{ $book->author }}</dd>
        <dt>Harga</dt>
        <dd>Rp {{ number_format((float) $book->price, 0, ',', '.') }}</dd>
        <dt>Stok</dt>
        <dd>{{ $book->stock }}</dd>
    </dl>
    <a href="{{ route('books.index') }}">Kembali</a>
@endsection --}}
