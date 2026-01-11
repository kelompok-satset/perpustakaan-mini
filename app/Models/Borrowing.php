<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // --- INI YANG KURANG TADI ---
    // Daftar kolom yang boleh diisi secara otomatis
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_deadline',
        'return_date',
        'status',
    ];

    // Relasi ke User (Peminjam)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Buku (Yang dipinjam)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}