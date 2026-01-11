<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'admin',
        ]);

        // 2. Buat Akun User (Mahasiswa)
        User::create([
            'name' => 'Mahasiswa Rajin',
            'email' => 'user@perpus.com',
            'password' => Hash::make('password'), // passwordnya: password
            'role' => 'user',
        ]);
    }
}