<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class BorrowingController extends Controller
{
    // --- 1. FUNGSI PINJAM BUKU (STORE) ---
    public function store(Request $request, Book $book)
    {
        // Cek Stok Buku
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        // Cek Aturan: Maksimal pinjam 3 buku
        $activeBorrows = Borrowing::where('user_id', auth()->id())
                            ->where('status', 'BORROWED')
                            ->count();

        if ($activeBorrows >= 3) {
            return back()->with('error', 'Gagal! Kamu masih meminjam 3 buku yang belum dikembalikan.');
        }

        // Catat Peminjaman
        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'return_deadline' => Carbon::now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        // Kurangi Stok Buku
        $book->decrement('stock');

        return back()->with('success', 'Berhasil meminjam buku!');
    }

    // --- 2. FUNGSI KEMBALIKAN BUKU (RETURNBOOK) ---
    public function returnBook(Request $request, Borrowing $borrowing)
    {
        // Cek apakah admin?
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Ubah Status & Tanggal Kembali
        $borrowing->update([
            'status' => 'RETURNED',
            'return_date' => now(),
        ]);

        // Kembalikan Stok Buku
        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

    // --- 3. FUNGSI HAPUS RIWAYAT (DESTROY) ---
    public function destroy(Borrowing $borrowing)
    {
        // Cek apakah admin?
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Hapus Data
        $borrowing->delete();

        // Kembali
        return back()->with('success', 'Riwayat peminjaman berhasil dihapus!');
    }
}