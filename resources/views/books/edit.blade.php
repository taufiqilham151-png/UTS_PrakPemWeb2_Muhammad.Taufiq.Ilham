<h1>Edit Buku</h1>

<form action="/books/{{ $book->id }}" method="POST">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label>Judul Buku:</label><br>
        <input type="text" name="title" value="{{ old('title', $book->title) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Penulis:</label><br>
        <input type="text" name="author" value="{{ old('author', $book->author) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
    <label>Tahun Terbit:</label><br>
    <input type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" min="1900" max="2099" required style="width: 300px; padding: 5px;">
    </div>

    <div>
    <label for="stok">Stok:</label><br>
    <input type="number" name="stok" value="{{ $book->stok }}">
    </div>

    <div class="form-group">
    <label for="description">Deskripsi Buku:</label>
    <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('description', $book->description) }}</textarea>
    </div>

    <button type="submit" style="padding: 6px 12px;">Simpan Perubahan</button>
    <a href="/books" style="margin-left: 10px;">Batal</a>

    
</form>