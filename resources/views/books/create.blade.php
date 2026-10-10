@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        padding: 20px;
    }

    /* Container utama dengan border */
    .card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 24px;
        max-width: 450px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn-submit {
        background-color: #007bff;
        color: white;
        padding: 9px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }
</style>


<div class="card">
    <h2>Tambah Buku</h2>
<form action="{{ route('books.store') }}" method="POST">
    @csrf <!-- WAJIB untuk Laravel agar form bisa dikirim -->

    <div>
        <label>Judul Buku:</label>
        <input type="text" name="title" required>
    </div>

    <div>
        <label>Penulis:</label>
        <input type="text" name="author" required>
    </div>

    <div>
        <label>Tahun Terbit:</label>
        <input type="number" name="publication_year" required>
    </div>
    
    <div>
    <label for="stok">Stok Buku:</label>
    <input type="number" name="stok" id="stok" value="{{ old('stok', $book->stok ?? 0) }}" required>
    </div>

    <div class="form-group">
    <label for="description">Deskripsi Buku:</label>
    <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
    </div>
    
    <button type="submit">Simpan</button>
</form>
@endsection
