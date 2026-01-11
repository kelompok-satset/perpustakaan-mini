<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <div class="mb-4">
                            <label class="block text-gray-700">Judul Buku</label>
                            <input type="text" name="title" value="{{ $book->title }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Penulis</label>
                            <input type="text" name="author" value="{{ $book->author }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class="w-1/2">
                                <label class="block text-gray-700">Tahun Terbit</label>
                                <input type="number" name="year" value="{{ $book->year }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700">Stok</label>
                                <input type="number" name="stock" value="{{ $book->stock }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">Kategori</label>
                            <select name="category" class="w-full border rounded px-3 py-2">
                                <option value="Fiksi" {{ $book->category == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                <option value="Non-Fiksi" {{ $book->category == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                <option value="Sains" {{ $book->category == 'Sains' ? 'selected' : '' }}>Sains</option>
                                <option value="Sejarah" {{ $book->category == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Cover Buku</label>
                            
                            @if($book->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="Cover Saat Ini" class="w-32 h-48 object-cover rounded border shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                                </div>
                            @endif

                            <input type="file" name="image" class="w-full border rounded px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Buku
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>