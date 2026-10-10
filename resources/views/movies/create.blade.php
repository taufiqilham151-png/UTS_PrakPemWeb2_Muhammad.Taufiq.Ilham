<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        .container { max-width: 500px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #45a049; }
        a { display: inline-block; margin-top: 10px; color: #666; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Film</h2>
        <form action="/movies" method="POST">
            @csrf
            <div class="form-group">
                <label>Judul Film:</label>
                <input type="text" name="judul" required>
            </div>
            <div class="form-group">
                <label>Sutradara:</label>
                <input type="text" name="sutradara" required>
            </div>
            <div class="form-group">
                <label>Tahun:</label>
                <input type="number" name="tahun" required>
            </div>
            <button type="submit">Simpan Film</button>
        </form>
        <a href="/movies">&larr; Kembali ke Daftar Film</a>
    </div>
</body>
</html>
