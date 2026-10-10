<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $search = $request->input('search');

            $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', '%' . $search . '%')
                     ->orWhere('author', 'like', '%' . $search . '%');
         })
            ->latest() // <--- Tambahkan ini agar data terbaru di atas
            ->paginate(10);

    $books->appends(['search' => $search]);

            $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                     ->orWhere('author', 'like', '%' . $search . '%');
            })->paginate(10);

            $books->appends(['search' => $search]);

            return view('books.index', compact('books', 'search'));

        
            //  $books = Book::paginate(10);
            //  return view('books.index', compact('books'));
            //   ->latest()
            //  ->paginate(10);

        //         $books = [
        //     [

        //         'id' => 1,
        //         'title' => 'Dasar Pemrograman Web',
        //         'author' => 'Ayu Pratama',
        //     ],
        //     [
        //         'id' => 2,
        //         'title' => 'Basis Data Terapan',
        //         'author' => 'Bima Nugraha',
        //     ],
        // ];

        // return view('books.index', compact('books'));
    }

    public function show(int $id): View
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
            return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
    'judul_buku' => 'required',
    'penulis'    => 'required',
    'tahun_terbit' => 'required|numeric',
    'stok'       => 'required|numeric|min:0',
]);

// Simpan data

        $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publication_year' => 'required|numeric',
    ]);

    

    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|numeric',
    ]);

    Book::create($request->all());

    return redirect('/books')->with('success', 'Data buku berhasil ditambahkan!');
    return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
        // $validated = $request->validate([
        // 'title' => ['required', 'string', 'max:255'],
        // 'isbn' => [
        //     'nullable',
        //     'string',
        //     'max:20',
        //     'unique:books,isbn',
        // ],
        // 'author' => ['required', 'string', 'max:150'],
        // 'publisher' => ['nullable', 'string', 'max:150'],
        // 'published_year' => [
        //     'nullable',
        //     'integer',
        //     'min:1900',
        //     'max:'.date('Y'),
        // ],
        // 'price' => ['required', 'numeric', 'min:0'],
        // 'stock' => ['required', 'integer', 'min:0'],
        // 'description' => ['nullable', 'string'],
    // ]);

    Book::create($validated);

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publication_year' => 'required|numeric', 
        'stok'         => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ]);

    $book->update([
        'title'            => $request->title,
        'author'           => $request->author,
        'publication_year' => $request->publication_year,
        'stock'            => $request->stok, // Ubah 'stok' menjadi 'stock' (sesuai Model & Database)
        'description'      => $request->description, // Tambahkan ini agar deskripsi juga ter-update
    ]);

    return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
    $book->delete();

    return redirect('/books')->with('success', 'Data buku berhasil dihapus!');
    }
}
