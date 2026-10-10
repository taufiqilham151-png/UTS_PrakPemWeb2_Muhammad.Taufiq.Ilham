<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        // Ambil data dari session, jika belum ada gunakan data default statis
        $movies = session()->get('movies', [
            [
                'id' => 1,
                'judul' => 'Laskar Pelangi',
                'sutradara' => 'Riri Riza',
                'tahun' => 2008
            ],
            [
                'id' => 2,
                'judul' => 'Pengabdi Setan',
                'sutradara' => 'Joko Anwar',
                'tahun' => 2017
            ],
            [
                'id' => 3,
                'judul' => 'AADC (Ada Apa Dengan Cinta?)',
                'sutradara' => 'Rudy Soedjarwo',
                'tahun' => 2002
            ],
            [
                'id' => 4,
                'judul' => 'Nanti Kita Cerita Tentang Hari Ini',
                'sutradara' => 'Angga Dwimas Sasongko',
                'tahun' => 2020
            ],
        ]);

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required',
            'sutradara' => 'required',
            'tahun' => 'required|numeric',
        ]);

        // Ambil data film yang ada di session saat ini
        $movies = session()->get('movies', []);

        // Buat ID baru otomatis
        $newId = count($movies) > 0 ? end($movies)['id'] + 1 : 1;

        // Tambah data baru ke array
        $movies[] = [
            'id' => $newId,
            'judul' => $request->judul,
            'sutradara' => $request->sutradara,
            'tahun' => $request->tahun,
        ];

        // Simpan kembali ke session
        session()->put('movies', $movies);

        return redirect('/movies')->with('success', 'Film berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $movies = session()->get('movies', []);
        
        // Cari data film berdasarkan ID
        $movie = null;
        foreach ($movies as $m) {
            if ($m['id'] == $id) {
                $movie = $m;
                break;
            }
        }

        if (!$movie) {
            return redirect('/movies')->with('error', 'Film tidak ditemukan!');
        }

        return view('movies.edit', compact('movie'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'sutradara' => 'required',
            'tahun' => 'required|numeric',
        ]);

        $movies = session()->get('movies', []);

        foreach ($movies as &$movie) {
            if ($movie['id'] == $id) {
                $movie['judul'] = $request->judul;
                $movie['sutradara'] = $request->sutradara;
                $movie['tahun'] = $request->tahun;
                break;
            }
        }

        session()->put('movies', $movies);

        return redirect('/movies')->with('success', 'Film berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $movies = session()->get('movies', []);

        // Filter array untuk membuang film dengan ID yang dipilih
        $movies = array_values(array_filter($movies, function ($movie) use ($id) {
            return $movie['id'] != $id;
        }));

        session()->put('movies', $movies);

        return redirect('/movies')->with('success', 'Film berhasil dihapus!');
    }

}
