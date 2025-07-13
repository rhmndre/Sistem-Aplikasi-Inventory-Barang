<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Faktur') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('adminbarang.faktur.edit', $faktur) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit Faktur
                </a>
                <a href="{{ route('adminbarang.faktur.print', $faktur->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Cetak Faktur
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b border-gray-200 pb-8 mb-8">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="mb-6">
                                    <img src="{{ asset('Logo-PAMR.png') }}" alt="Logo" class="h-16">
                                </div>
                                <h3 class="text-lg font-bold mb-2">PT. Pupuk Alam Makmur Raya</h3>
                                <p class="text-gray-600">Jl. Raya Pupuk No. 123</p>
                                <p class="text-gray-600">Telp: (021) 123-4567</p>
                                <p class="text-gray-600">Email: info@pamr.co.id</p>
                            </div>
                            <div class="text-right">
                                <h1 class="text-3xl font-bold mb-4">FAKTUR</h1>
                                <p class="text-gray-600 mb-1">Nomor: {{ $faktur->nomor_faktur }}</p>
                                <p class="text-gray-600 mb-1">Tanggal: {{ \Carbon\Carbon::parse($faktur->tanggal_faktur)->format('d/m/Y') }}</p>
                                <p class="text-gray-600">ID Transaksi: {{ $faktur->id_transaksi }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-300">
                                    <th class="text-left py-3">Nama Barang</th>
                                    <th class="text-left py-3">Jenis</th>
                                    <th class="text-center py-3">Jumlah</th>
                                    <th class="text-right py-3">Harga Satuan</th>
                                    <th class="text-right py-3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200">
                                    <td class="py-4">{{ $faktur->nama_barang }}</td>
                                    <td class="py-4">{{ $faktur->jenis_barang }}</td>
                                    <td class="py-4 text-center">{{ $faktur->jumlah }} {{ $faktur->satuan }}</td>
                                    <td class="py-4 text-right">Rp {{ number_format($faktur->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="py-4 text-right">Rp {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="border-t-2 border-gray-300">
                                    <td colspan="4" class="py-4 text-right font-bold">Total:</td>
                                    <td class="py-4 text-right font-bold">Rp {{ number_format($faktur->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($faktur->keterangan)
                        <div class="mb-8">
                            <h4 class="font-semibold mb-2">Keterangan:</h4>
                            <p class="text-gray-600">{{ $faktur->keterangan }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-8 mt-8">
                        <div>
                            <p class="text-sm text-gray-600">Catatan:</p>
                            <p class="text-sm text-gray-600">1. Faktur ini adalah bukti resmi pembayaran</p>
                            <p class="text-sm text-gray-600">2. Mohon simpan faktur ini sebagai bukti transaksi</p>
                        </div>
                        <div class="text-right">
                            <p class="mb-16">Hormat kami,</p>
                            <p class="font-semibold">PT. Pupuk Alam Makmur Raya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 