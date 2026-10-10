<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        h2 { color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-control { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { background-color: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; display: inline-block; }
        .btn:hover { background-color: #45a049; }
        .btn-secondary { background-color: #6c75d7; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Film</h2>

        <!-- Diperbarui menggunakan array ['id'] -->
        <form action="{{ route('movies.update', $movie['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul Film</label>
                <!-- Diperbarui name="judul" dan menggunakan array ['judul'] -->
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $movie['judul']) }}" required>
            </div>

            <div class="form-group">
                <label>Sutradara</label>
                <!-- Diperbarui name="sutradara" dan menggunakan array ['sutradara'] -->
                <input type="text" name="sutradara" class="form-control" value="{{ old('sutradara', $movie['sutradara']) }}" required>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <!-- Diperbarui name="tahun" dan menggunakan array ['tahun'] -->
                <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $movie['tahun']) }}" required>
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="/movies" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>