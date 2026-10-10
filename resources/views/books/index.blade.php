<h1 style="text-align: center; font-size: 100px;">Data Buku</h1>

<form action="/books" method="GET" style="margin-bottom: 20px;">
    <input 
        type="text" 
        name="search" 
        placeholder="Cari judul atau penulis..." 
        value="{{ request('search') }}" 
        style="padding: 6px 10px; width: 250px;"
    >
    <button type="submit" style="padding: 6px 12px; cursor: pointer;">Cari</button>

    @if (request('search'))
        <a href="/books" style="margin-left: 10px; text-decoration: none;">Reset</a>
    @endif
</form>

<div style="margin-bottom: 15px;">
    <a href="/books/create" style="padding: 8px 12px; background-color: #89918b; color: rgb(7, 7, 7); text-decoration: none; border-radius: 4px;">
        + Tambah Data Buku
    </a>
</div>

<table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <style>
  table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-collapse: collapse;
  }

  th {
    background-color: #e546bb;
    color: #131212;
    font-weight: 600;
    padding: 8px 12px;
    text-align: left;
    border: 1px solid #000000
  }

  td {
    padding: 8px 12px;
    border-bottom: 1px solid #E5E7EB;
    color: #1420c4;
  }

  tbody tr:nth-child(even) {
    background-color: #b1b7b7;
  }

  tbody tr:hover {
    background-color: #feffee;
  }

  td a {
    color: #000000;
    text-decoration: none;
    font-weight: 600;
  }

  td a:hover {
    text-decoration: underline;
  }
</style>
<style>
  table th, 
  table td, 
  table td a {
    color: #000000 !important; 
    font-weight: bold !important;
  }
</style>
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="width: 50px; text-align: center;">No</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th style="text-align: center;">Tahun Terbit</th>
            <th>Stok</th>
            <th style="text-align: center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $index => $book)
            <tr>
                <td style="text-align: center;">{{ $books->firstItem() + $index }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td style="text-align: center;">{{ $book->publication_year ?? '-' }}</td>
                <td>{{ $book->stock }}</td>
                <td style="text-align: center;">
                <a href="{{ route('books.show', $book->id) }}" 
                style="display: block; width: 80px; padding: 6px 0; background-color: #2113e2; color: rgb(0, 0, 0); text-align: center; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; box-sizing: border-box; margin: 0 auto;">Detail</a>
                <a href="/books/{{ $book->id }}/edit" 
                style="display: block; width: 80px; padding: 6px 0;  color: rgb(0, 0, 0); text-align: center; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold; box-sizing: border-box; margin: 0 auto;">Edit</a>
                <form action="/books/{{ $book->id }}" method="POST" style="margin: 0 auto; padding: 0; display: flex; justify-content: center; width: 100%;" onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                style="display: block; width: 80px; padding: 6px 0; background-color: #d30c0c; color: rgb(0, 0, 0); border: none; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; box-sizing: border-box; margin: 0 auto;">Hapus</button>
                </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Data belum tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@if ($books->hasPages())
    <nav style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; padding: 10px; background-color: #f8f9fa; border-radius: 8px;">
        @if ($books->onFirstPage())
            <a href="#" style="padding: 6px 12px; background: #007bff; color: white; border-radius: 4px; text-decoration: none;">&laquo; Sebelumnya</a>
        @else
            <a href="{{ $books->previousPageUrl() }}">Sebelumnya</a>
        @endif

        <span style="font-weight: bold; color: #555;">Halaman 1 dari 3</span>

        @if ($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}">Berikutnya</a>
        @else
            <a href="#" style="padding: 6px 12px; background: #007bff; color: white; border-radius: 4px; text-decoration: none;">Berikutnya &raquo;</a>
        @endif
    </nav>
@endif
