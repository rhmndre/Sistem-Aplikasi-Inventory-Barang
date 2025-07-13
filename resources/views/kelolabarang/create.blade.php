<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('adminbarang.kelolabarang.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="id_barang" value="ID Barang" />
                            <x-text-input id="id_barang" class="block mt-1 w-full bg-gray-100" type="text" name="id_barang" :value="$nextId" disabled />
                        </div>

                        <div>
                            <x-input-label for="nama_barang" value="Nama Barang" />
                            <x-text-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jenis_barang_id" value="Jenis Barang" />
                            <select id="jenis_barang_id" name="jenis_barang_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenisBarangs as $jenisBarang)
                                    <option value="{{ $jenisBarang->id }}" {{ old('jenis_barang_id') == $jenisBarang->id ? 'selected' : '' }}>
                                        {{ $jenisBarang->jenis_barang }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis_barang_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stok" value="Stok Minimum" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', 0)" required />
                            <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="satuan_id" value="Satuan" />
                            <select id="satuan_id" name="satuan_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Satuan</option>
                                @foreach($satuans as $satuan)
                                    <option value="{{ $satuan->id }}" {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                        {{ $satuan->nama_satuan }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('satuan_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="foto" value="Foto Barang" />
                            <input type="file" id="foto" name="foto" accept="image/jpeg,image/png" 
                                   class="block w-full text-sm text-gray-500 mt-1
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-purple-50 file:text-purple-700
                                          hover:file:bg-purple-100"/>
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, atau PNG. Maksimal 2MB.</p>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('adminbarang.kelolabarang.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
