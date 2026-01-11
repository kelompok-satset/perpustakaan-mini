<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Laporan Peminjaman') }}
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
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Daftar Peminjaman</h3>
                        <a href="{{ route('books.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kelola Buku
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2 text-left">Peminjam</th>
                                    <th class="border px-4 py-2 text-left">Buku</th>
                                    <th class="border px-4 py-2 text-left">Tgl Pinjam</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-left" width="250">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($borrowings as $borrow)
                                <tr>
                                    <td class="border px-4 py-2">{{ $borrow->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $borrow->book->title }}</td>
                                    <td class="border px-4 py-2">{{ $borrow->borrow_date }}</td>
                                    <td class="border px-4 py-2">
                                        @if($borrow->status == 'BORROWED')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                DIPINJAM
                                            </span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                DIKEMBALIKAN
                                            </span>
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $borrow->return_date }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center gap-2">
                                            @if($borrow->status == 'BORROWED')
                                                <form action="{{ route('borrow.return', $borrow->id) }}" method="POST" onsubmit="return confirm('Yakin buku ini sudah dikembalikan?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded text-sm font-bold">
                                                        Kembali
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-sm italic mr-2">Selesai</span>
                                            @endif

                                            <form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded text-sm font-bold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                        Belum ada transaksi peminjaman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>