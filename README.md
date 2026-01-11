# 📚 Pustaka Kampus - Sistem Informasi Perpustakaan Digital

Sistem Informasi Perpustakaan berbasis web yang dibangun menggunakan **Laravel** dan **Tailwind CSS**. Aplikasi ini memungkinkan mahasiswa untuk mencari dan meminjam buku, serta admin untuk mengelola katalog buku dan laporan peminjaman.

---

## 👥 Anggota Kelompok

**Tugas Kelompok Pemrograman Web Lanjut**

| No | Nama Lengkap | NIM | Peran (Jobdesk) |
|----|--------------|-----|-----------------|
| 1. | **[syaifus sholihin putra aditama]** | [2402510001] | Project Manager & Fullstack |
| 2. | **[riyan subhan akbar]** | [2402510017] | Backend Developer |
| 3. | **[moh ferdiansyah brawijayanto]** | [2402510021] | Frontend & UI/UX |
| 4. | **[sakinah hidayati]** | [2402510019] | Database & QA |

---

## 🚀 Fitur Unggulan

### 🌍 Halaman Publik (Guest)
* **Landing Page Modern:** Menampilkan katalog buku terbaru tanpa perlu login.
* **About Team:** Halaman profil tim pengembang dengan foto.
* **Navigasi:** Akses mudah ke Login dan Register.

### 👤 Dashboard User (Mahasiswa)
* **Katalog Buku:** Melihat daftar buku dengan tampilan cover yang rapi (Grid Layout).
* **Pencarian Canggih:** Mencari buku berdasarkan Judul, Penulis, atau Kategori.
* **Peminjaman:** Fitur *one-click* untuk meminjam buku (jika stok tersedia).
* **Status Peminjaman:** Tabel real-time untuk melihat buku yang sedang dipinjam, tanggal pinjam, dan batas waktu kembali.

### 🛡️ Dashboard Admin
* **akun admin:** email: admin@perpus.com, passwordnya: password.
* **Manajemen Buku (CRUD):** Tambah, Edit, Hapus buku beserta **Upload Gambar Cover**.
* **Laporan Peminjaman:** Memantau siapa yang meminjam buku.
* **Proses Pengembalian:** Tombol untuk memproses pengembalian buku (stok otomatis bertambah).
* **Hapus Riwayat:** Membersihkan data transaksi yang sudah selesai.

---

## 🛠️ Teknologi yang Digunakan

* **Framework:** Laravel 12
* **Language:** PHP 8.2
* **Frontend:** Blade Templating + Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Breeze
* **Assets Manager:** Vite

---

## 💻 Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal:

### 1. Clone Repository
Download atau clone project ini ke komputer Anda.
```bash
git clone [https://github.com/kelompok-satset/perpustakaan-mini.git](https://github.com/kelompok-satset/perpustakaan-mini.git)
cd perpustakaan-mini