<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
           $table->id();
        // Relasi: Siapa yang pinjam? (ambil ID dari tabel users)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Relasi: Buku apa yang dipinjam? (ambil ID dari tabel books)
        $table->foreignId('book_id')->constrained()->onDelete('cascade');
        
        $table->date('borrow_date');       // Tgl Pinjam
        $table->date('return_deadline');   // Batas Kembali
        $table->date('return_date')->nullable(); // Tgl Dikembalikan (kosong dulu)
        $table->enum('status', ['BORROWED', 'RETURNED'])->default('BORROWED');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
