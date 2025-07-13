<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Barang Masuk
            </h2>
            <div class="flex gap-4">
                <a href="{{ route('adminbarang.barangmasuk.import') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Import CSV
                </a>
            <a href="{{ route('adminbarang.barangmasuk.create') }}" 
               class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Barang Masuk</span>
            </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">Show</span>
                            <select id="per-page" class="border border-gray-300 rounded-md text-gray-600 px-2 py-1">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="text-gray-600">entries</span>
                                    </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">Search:</span>
                            <input type="text" id="search" class="border border-gray-300 rounded-md px-3 py-1">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Masuk</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                                @foreach($barangmasuks as $index => $barangmasuk)
                                    <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barangmasuk->id_transaksi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barangmasuk->tanggal }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barangmasuk->barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $barangmasuk->jumlah_masuk }}
                                            </span>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $barangmasuk->satuan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <a href="{{ route('adminbarang.barangmasuk.show', $barangmasuk->id) }}" 
                                                class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                                <a href="{{ route('adminbarang.barangmasuk.edit', $barangmasuk->id) }}" 
                                                class="text-yellow-600 hover:text-yellow-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            <form action="{{ route('adminbarang.barangmasuk.destroy', $barangmasuk->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
