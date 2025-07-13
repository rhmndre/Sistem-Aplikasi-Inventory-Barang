<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('adminbarang.barangkeluar.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="id_transaksi" value="ID Transaksi" />
                                <x-text-input id="id_transaksi" name="id_transaksi" type="text" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('id_transaksi')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tanggal" value="Tanggal" />
                                <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="barang" value="Barang" />
                                <select id="barang" name="barang" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($kelolabarangs as $barang)
                                        <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('barang')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jumlah_keluar" value="Jumlah Keluar" />
                                <x-text-input id="jumlah_keluar" name="jumlah_keluar" type="number" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('jumlah_keluar')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="satuan" value="Satuan" />
                                <select id="satuan" name="satuan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($satuans as $satuan)
                                        <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                                <a href="{{ route('adminbarang.barangkeluar.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Batal') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
