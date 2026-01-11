<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-4">
                        <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Buku
                        </a>
                    </div>

                    <table class="min-w-full border mt-4">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Penulis</th>
                                <th class="border px-4 py-2 text-left">Stok</th>
                                <th class="border px-4 py-2 text-left">Kategori</th>
                                <th class="border px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr>
                                <td class="border px-4 py-2">{{ $book->title }}</td>
                                <td class="border px-4 py-2">{{ $book->author }}</td>
                                <td class="border px-4 py-2">{{ $book->stock }}</td>
                                <td class="border px-4 py-2">{{ $book->category }}</td>
                                <td class="border px-4 py-2 flex items-center gap-2">
                                    
                                    <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:text-blue-700 font-bold">
                                        Edit
                                    </a>

                                    <span class="text-gray-300">|</span>

                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                    Belum ada buku. Silakan tambah buku baru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>