<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Faktur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('adminbarang.faktur.update', $faktur) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nomor_faktur" value="Nomor Faktur" />
                                <x-text-input id="nomor_faktur" name="nomor_faktur" type="text" class="mt-1 block w-full" :value="old('nomor_faktur', $faktur->nomor_faktur)" required />
                                <x-input-error :messages="$errors->get('nomor_faktur')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tanggal_faktur" value="Tanggal Faktur" />
                                <x-text-input id="tanggal_faktur" name="tanggal_faktur" type="date" class="mt-1 block w-full" :value="old('tanggal_faktur', $faktur->tanggal_faktur)" required />
                                <x-input-error :messages="$errors->get('tanggal_faktur')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="id_transaksi" value="ID Transaksi" />
                                <select id="id_transaksi" name="id_transaksi" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih ID Transaksi</option>
                                    @foreach($barangMasuks as $barangMasuk)
                                        <option value="{{ $barangMasuk->id_transaksi }}" {{ old('id_transaksi', $faktur->id_transaksi) == $barangMasuk->id_transaksi ? 'selected' : '' }}>
                                            {{ $barangMasuk->id_transaksi }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_transaksi')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nama_barang" value="Nama Barang" />
                                <select id="nama_barang" name="nama_barang" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($kelolaBarangs as $barang)
                                        <option value="{{ $barang->nama_barang }}" 
                                                data-jenis="{{ $barang->jenis_barang }}" 
                                                data-satuan="{{ $barang->satuan }}"
                                                {{ old('nama_barang', $faktur->nama_barang) == $barang->nama_barang ? 'selected' : '' }}>
                                            {{ $barang->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('nama_barang')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jenis_barang" value="Jenis Barang" />
                                <x-text-input id="jenis_barang" name="jenis_barang" type="text" class="mt-1 block w-full bg-gray-100" :value="old('jenis_barang', $faktur->jenis_barang)" readonly />
                                <x-input-error :messages="$errors->get('jenis_barang')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jumlah" value="Jumlah" />
                                <x-text-input id="jumlah" name="jumlah" type="number" class="mt-1 block w-full" :value="old('jumlah', $faktur->jumlah)" required />
                                <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="satuan" value="Satuan" />
                                <x-text-input id="satuan" name="satuan" type="text" class="mt-1 block w-full bg-gray-100" :value="old('satuan', $faktur->satuan)" readonly />
                                <x-input-error :messages="$errors->get('satuan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="harga_satuan" value="Harga Satuan" />
                                <x-text-input id="harga_satuan" name="harga_satuan" type="number" class="mt-1 block w-full" :value="old('harga_satuan', $faktur->harga_satuan)" required />
                                <x-input-error :messages="$errors->get('harga_satuan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="total_harga" value="Total Harga" />
                                <x-text-input id="total_harga" name="total_harga" type="number" class="mt-1 block w-full bg-gray-100" :value="old('total_harga', $faktur->total_harga)" readonly />
                                <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
                            </div>

                            <div class="col-span-2">
                                <x-input-label for="keterangan" value="Keterangan" />
                                <textarea id="keterangan" name="keterangan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('keterangan', $faktur->keterangan) }}</textarea>
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('adminbarang.faktur.show', $faktur) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaBarangSelect = document.getElementById('nama_barang');
            const jenisBarangInput = document.getElementById('jenis_barang');
            const satuanInput = document.getElementById('satuan');
            const jumlahInput = document.getElementById('jumlah');
            const hargaSatuanInput = document.getElementById('harga_satuan');
            const totalHargaInput = document.getElementById('total_harga');

            namaBarangSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                jenisBarangInput.value = selectedOption.dataset.jenis || '';
                satuanInput.value = selectedOption.dataset.satuan || '';
                calculateTotal();
            });

            jumlahInput.addEventListener('input', calculateTotal);
            hargaSatuanInput.addEventListener('input', calculateTotal);

            function calculateTotal() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
                totalHargaInput.value = jumlah * hargaSatuan;
            }
        });
    </script>
    @endpush
</x-app-layout> 