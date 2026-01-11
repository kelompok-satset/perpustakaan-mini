<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="mb-4">
                            <label class="block text-gray-700">Judul Buku</label>
                            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Penulis</label>
                            <input type="text" name="author" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class="w-1/2">
                                <label class="block text-gray-700">Tahun Terbit</label>
                                <input type="number" name="year" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700">Stok Awal</label>
                                <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Kategori</label>
                            <select name="category" class="w-full border rounded px-3 py-2">
                                <option value="Fiksi">Fiksi</option>
                                <option value="Non-Fiksi">Non-Fiksi</option>
                                <option value="Sains">Sains</option>
                                <option value="Sejarah">Sejarah</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Cover Buku (Gambar)</label>
                            <input type="file" name="image" class="w-full border rounded px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks 2MB. (Opsional)</p>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Buku
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>