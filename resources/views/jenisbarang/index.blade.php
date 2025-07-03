<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Jenis Barang
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('superadmin.jenisbarang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                        + Tambah Jenis Barang
                    </a>
                    <input type="text" placeholder="Cari..." class="border px-3 py-1 rounded-lg shadow text-sm w-1/3">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded shadow-sm">
                        <thead class="bg-purple-100 text-gray-700 text-sm uppercase tracking-wide">
                            <tr>
                                <th class="px-4 py-3 border">No.</th>
                                <th class="px-4 py-3 border">Jenis Barang</th>
                                <th class="px-4 py-3 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($jenisBarangs as $index => $jenis)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 border">{{ $jenis->jenis_barang }}</td>
                                    <td class="px-4 py-3 border text-center space-x-2">
                                        <a href="{{ route('jenisbarang.show', $jenis->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 hover:bg-blue-600 text-white rounded-full" title="Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0A9 9 0 1112 3a9 9 0 019 9z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('jenisbarang.edit', $jenis->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-purple-500 hover:bg-purple-600 text-white rounded-full" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-5.586-6.414a2 2 0 112.828 2.828L11 17H7v-4l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('jenisbarang.destroy', $jenis->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if(count($jenisBarangs) == 0)
                        <div class="p-4 text-center text-gray-500">Data belum tersedia.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
