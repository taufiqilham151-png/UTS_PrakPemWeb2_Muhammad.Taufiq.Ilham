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
        ->latest() // Agar data terbaru muncul di urutan paling atas
        ->paginate(10);

        $books->appends(['search' => $search]);

        return view('books.index', compact('books', 'search'));
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
        // 1. Validasi data sesuai dengan name di form create.blade.php
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'publication_year' => 'required|numeric',
            'stok'             => 'required|numeric|min:0',
            'description'      => 'nullable|string',
        ]);

        // 2. Simpan data ke database
        Book::create($validated);

        // 3. Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

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
            'title'            => 'required',
            'author'           => 'required',
            'publication_year' => 'required|numeric', 
            'stock' => 'required|integer',
            'description'      => 'nullable|string',
        ]);

        $book->update([
            'title'            => $request->title,
            'author'           => $request->author,
            'publication_year' => $request->publication_year,
            'stock'             => $request->stock, // Pastikan kolom di database Anda bernama 'stok'
            'description'      => $request->description,
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

        return redirect()->route('books.index')->with('success', 'Data buku berhasil dihapus!');
    }
}
