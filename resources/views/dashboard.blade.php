<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pustaka Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="mb-8">
                <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Cari judul buku, penulis, atau kategori..." required>
                        
                        @if(request('search'))
                            <a href="{{ route('dashboard') }}" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-red-500 transition" title="Hapus pencarian">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        @endif
                    </div>
                    
                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-bold rounded-lg text-sm px-6 py-2.5 shadow-md transition transform active:scale-95">
                        Cari
                    </button>
                </form>
            </div>
            <div class="mb-12">
                <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center justify-between">
                    @if(request('search'))
                        <span>Hasil Pencarian: <span class="text-indigo-600">"{{ request('search') }}"</span></span>
                        <span class="text-xs font-normal text-gray-500 bg-gray-200 px-2 py-1 rounded-full">{{ $books->count() }} ditemukan</span>
                    @else
                        <span>Koleksi Buku Terbaru</span>
                    @endif
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($books as $book)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full flex flex-col hover:shadow-lg transition-shadow duration-300">
                        
                        @if($book->image)
                            <div style="height: 250px; overflow: hidden; width: 100%;">
                                <img src="{{ asset('storage/' . $book->image) }}" 
                                     alt="{{ $book->title }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            </div>
                        @else
                            <div style="height: 250px; width: 100%; background-color: #e5e7eb; display: flex; align-items: center; justify-content: center;">
                                <span class="text-gray-500 font-semibold">No Image</span>
                            </div>
                        @endif

                        <div class="p-6 flex flex-col justify-between flex-grow">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2" title="{{ $book->title }}">{{ $book->title }}</h3>
                                <div class="text-gray-600 text-sm space-y-1">
                                    <p><span class="font-semibold">Penulis:</span> {{ $book->author }}</p>
                                    <p><span class="font-semibold">Kategori:</span> {{ $book->category }}</p>
                                    <p><span class="font-semibold">Tahun:</span> {{ $book->year }}</p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-sm font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    Stok: {{ $book->stock }}
                                </span>

                                @if($book->stock > 0)
                                    <form action="{{ route('borrow.store', $book->id) }}" method="POST">
                                        @csrf 
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded text-sm transition transform active:scale-95">
                                            Pinjam Buku
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="bg-gray-300 text-gray-500 cursor-not-allowed font-bold py-2 px-4 rounded text-sm">
                                        Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-1 md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-10 text-center text-gray-500 flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @if(request('search'))
                                <p class="text-lg font-semibold">Buku tidak ditemukan.</p>
                                <p class="text-sm mt-2">Coba gunakan kata kunci lain seperti judul, penulis, atau kategori.</p>
                                <a href="{{ route('dashboard') }}" class="mt-4 text-indigo-600 hover:underline font-bold">Kembali ke semua buku</a>
                            @else
                                <p>Belum ada buku yang tersedia di perpustakaan.</p>
                            @endif
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            @if(isset($myBorrows) && $myBorrows->count() > 0)
            <div class="mt-12 border-t pt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Sedang Kamu Pinjam
                </h3>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-indigo-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-indigo-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">Judul Buku</th>
                                    <th class="py-3 px-6 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="py-3 px-6 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">Batas Waktu</th>
                                    <th class="py-3 px-6 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($myBorrows as $borrow)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-6 text-sm font-semibold text-gray-900">
                                        {{ $borrow->book->title }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-red-600 font-bold">
                                        {{ \Carbon\Carbon::parse($borrow->return_deadline)->format('d M Y') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">
                                            DIPINJAM
                                        </span>
                                        <p class="text-[11px] text-gray-400 mt-1 italic">
                                            *Kembalikan ke Admin untuk hapus dari list ini
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>