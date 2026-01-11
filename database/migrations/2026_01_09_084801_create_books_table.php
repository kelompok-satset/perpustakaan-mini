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
        Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');      // Judul
        $table->string('author');     // Penulis
        $table->integer('year');      // Tahun
        $table->integer('stock');     // Stok buku
        $table->string('category');   // Kategori
        $table->string('image')->nullable(); // Foto (opsional)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
