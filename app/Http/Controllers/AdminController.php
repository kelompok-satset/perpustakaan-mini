<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing; // <--- PENTING: Wajib ada agar bisa ambil data laporan

class AdminController extends Controller
{
    public function index()
    {
        // 1. Cek Keamanan (Satpam)
        // Jika yang masuk BUKAN admin, tendang keluar (403)
        if (auth()->user()->role !== 'admin') {
            abort(403, 'AKSES DITOLAK: Anda bukan Admin');
        }

        // 2. Ambil Data Peminjaman (Laporan)
        // Kita ambil data borrowing, beserta data User dan Buku-nya (pakai with)
        // latest() artinya urutkan dari yang terbaru
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();

        // 3. Kirim data ke tampilan dashboard admin
        return view('admin.dashboard', compact('borrowings'));
    }
}