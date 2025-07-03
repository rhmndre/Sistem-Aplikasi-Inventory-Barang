<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Satuan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('superadmin.satuan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 transition">
                    Tambah Satuan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Barang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($satuans as $satuan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $satuan->jenis_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <a href="{{ route('satuan.edit', $satuan->id) }}" class="inline-flex items-center px-3 py-1 bg-yellow-400 text-white text-sm font-medium rounded hover:bg-yellow-500">Edit</a>
                                        <form action="{{ route('satuan.destroy', $satuan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($satuans->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Data tidak ditemukan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>