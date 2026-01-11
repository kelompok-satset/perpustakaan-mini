<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Panggil Model Book
use Illuminate\Support\Facades\Storage; // <--- PENTING: Panggil Storage biar bisa hapus gambar

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku (Halaman Index)
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') { abort(403); }

        $books = Book::all(); 
        return view('admin.books.index', compact('books'));
    }

    /**
     * Menampilkan Form Tambah Buku
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') { abort(403); }
        return view('admin.books.create');
    }

    /**
     * Menyimpan data buku baru (PLUS GAMBAR)
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }

        // 1. Validasi
        $validated = $request->validate([
            'title' => 'required|min:3',
            'author' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Cek Upload Gambar
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $validated['image'] = $path;
        }

        // 3. Simpan ke Database
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan Form Edit
     */
    public function edit(string $id)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }

        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Proses Update Data (PLUS GANTI GAMBAR)
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }

        // 1. Validasi
        $validated = $request->validate([
            'title' => 'required|min:3',
            'author' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $book = Book::findOrFail($id);

        // 2. Cek apakah ada gambar baru?
        if ($request->hasFile('image')) {
            
            // HAPUS GAMBAR LAMA (Jika ada)
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            // SIMPAN GAMBAR BARU
            $path = $request->file('image')->store('books', 'public');
            $validated['image'] = $path;
        }

        // 3. Update Database
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus Buku (PLUS HAPUS GAMBARNYA)
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role !== 'admin') { abort(403); }

        $book = Book::findOrFail($id);

        // Hapus gambar dari penyimpanan jika ada
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        // Hapus data dari database
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}