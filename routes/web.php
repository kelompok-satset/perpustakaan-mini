<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController; 
use App\Http\Controllers\BorrowingController;
use App\Models\Book;        // <--- Model Book
use App\Models\Borrowing;   // <--- Model Borrowing
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // <--- PENTING: Tambahkan ini untuk fitur pencarian

// 1. Halaman Depan (Landing Page)
Route::get('/', function () {
    // Ambil buku terbaru untuk halaman depan
    $books = Book::latest()->get();
    return view('welcome', compact('books'));
});

// TAMBAHAN: Route Halaman Tentang Pengembang (Public)
Route::get('/about', function () {
    return view('about');
})->name('about');

// Group Middleware untuk yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {

    // 2. Dashboard Utama (Pintu Masuk, Daftar Buku, & Pencarian)
    Route::get('/dashboard', function (Request $request) {
        // Cek: Jika Admin, lempar ke dashboard admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // A. LOGIKA PENCARIAN BUKU
        // Kita mulai query dari Model Book
        $query = Book::query();

        // Cek apakah user mengetik sesuatu di kotak pencarian?
        if ($request->has('search')) {
            $search = $request->search;
            // Cari data yang cocok di Judul, Penulis, atau Kategori
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }

        // Eksekusi query dan ambil datanya (urutkan dari yang terbaru)
        $books = $query->latest()->get();

        // B. Ambil data peminjaman KHUSUS User ini
        // Syarat: User ID cocok DAN Statusnya masih 'BORROWED'
        $myBorrows = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->where('status', 'BORROWED')
            ->get();

        // Kirim DUA data (books & myBorrows) ke tampilan dashboard user
        return view('dashboard', compact('books', 'myBorrows')); 
        
    })->name('dashboard');

    // --- 3. Route PROSES PINJAM BUKU ---
    Route::post('/borrow/{book}', [BorrowingController::class, 'store'])->name('borrow.store');

    // --- 4. Route Pengembalian Buku ---
    Route::patch('/borrow/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrow.return');

    // --- 5. Route Hapus Laporan ---
    Route::delete('/borrow/{borrowing}', [BorrowingController::class, 'destroy'])->name('borrow.destroy');
    // ---------------------------------------------

    // 6. Route Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // 7. Route Manajemen Buku (CRUD Admin)
    Route::resource('books', BookController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';