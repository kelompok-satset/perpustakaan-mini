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
        // --- PERBAIKAN DI SINI ---
        // Cek dulu: Kalau kolom 'image' BELUM ADA di tabel 'books', baru kita buat.
        if (!Schema::hasColumn('books', 'image')) {
            Schema::table('books', function (Blueprint $table) {
                $table->string('image')->nullable()->after('category');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Cek dulu sebelum menghapus (biar aman)
            if (Schema::hasColumn('books', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};