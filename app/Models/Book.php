<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // --- TAMBAHKAN INI ---
    protected $fillable = [
        'title',
        'author',
        'year',
        'stock',
        'category',
        'image', // Opsional, jaga-jaga kalau nanti mau pakai
    ];
}