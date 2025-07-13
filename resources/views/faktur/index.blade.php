<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Faktur') }}
            </h2>
            <a href="{{ route('adminbarang.faktur.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Buat Faktur Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <form action="{{ route('adminbarang.faktur.index') }}" method="GET" class="flex gap-4">
                            <div class="flex-1">
                                <x-text-input type="text" name="search" placeholder="Cari nomor faktur..." value="{{ request('search') }}" class="w-full"/>
                            </div>
                            <div class="flex-1">
                                <x-text-input type="date" name="date" value="{{ request('date') }}" class="w-full"/>
                            </div>
                            <x-primary-button type="submit">Cari</x-primary-button>
                            @if(request('search') || request('date'))
                                <a href="{{ route('adminbarang.faktur.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Faktur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($fakturs as $faktur)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $faktur->nomor_faktur }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $faktur->tanggal_faktur }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $faktur->id_transaksi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $faktur->nama_barang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $faktur->jumlah }} {{ $faktur->satuan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('adminbarang.faktur.show', $faktur->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('adminbarang.faktur.edit', $faktur->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                    Edit
                                                </a>
                                                <a href="{{ route('adminbarang.faktur.print', $faktur->id) }}" class="text-green-600 hover:text-green-900" target="_blank">
                                                    Cetak
                                                </a>
                                                <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus faktur ini?');" action="{{ route('adminbarang.faktur.destroy', $faktur->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data faktur
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($fakturs->hasPages())
                        <div class="mt-4">
                            {{ $fakturs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 