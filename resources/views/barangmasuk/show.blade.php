<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Barang Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('adminbarang.barangmasuk.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Kembali ke Daftar Barang Masuk
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Transaksi</h3>
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 text-gray-600">ID Transaksi</td>
                                    <td class="py-2">: {{ $barangmasuk->id_transaksi }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600">Tanggal</td>
                                    <td class="py-2">: {{ date('d/m/Y', strtotime($barangmasuk->tanggal)) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Detail Barang</h3>
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 text-gray-600">Nama Barang</td>
                                    <td class="py-2">: {{ $barangmasuk->barang }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-600">Jumlah Masuk</td>
                                    <td class="py-2">: {{ $barangmasuk->jumlah_masuk }} {{ $barangmasuk->satuan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('adminbarang.barangmasuk.edit', $barangmasuk->id) }}" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                            Edit
                        </a>
                        <form action="{{ route('adminbarang.barangmasuk.destroy', $barangmasuk->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 