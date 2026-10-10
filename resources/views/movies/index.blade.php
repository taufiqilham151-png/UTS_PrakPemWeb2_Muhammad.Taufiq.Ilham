<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film Statis</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        h1 { color: #333; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px; }
        .btn:hover { background-color: #45a049; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .alert { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f6f9;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <h1>Daftar Film Statis</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="/movies/create" class="btn">+ Tambah Film Baru</a>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Judul Film</th>
                <th>Sutradara</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $movie['judul'] }}</td>
                    <td>{{ $movie['sutradara'] }}</td>
                    <td>{{ $movie['tahun'] }}</td>
                   <td>
                        <!-- DIPERBAIKI: Menggunakan array ['id'] -->
                        <a href="{{ route('movies.edit', $movie['id']) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- DIPERBAIKI: Menggunakan array ['id'] -->
                        <form action="{{ route('movies.destroy', $movie['id']) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>