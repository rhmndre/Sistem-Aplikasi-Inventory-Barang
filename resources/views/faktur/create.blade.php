<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Faktur Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Buat Faktur Baru</h1>
                        <a href="{{ route('adminbarang.faktur.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>

                    <form action="{{ route('adminbarang.faktur.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nomor_faktur">
                                Nomor Faktur
                            </label>
                            <input type="text" name="nomor_faktur" id="nomor_faktur" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_faktur') border-red-500 @enderror"
                                value="{{ $nomorFaktur }}" readonly>
                            @error('nomor_faktur')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_faktur">
                                Tanggal Faktur
                            </label>
                            <input type="date" name="tanggal_faktur" id="tanggal_faktur" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_faktur') border-red-500 @enderror"
                                value="{{ old('tanggal_faktur', date('Y-m-d')) }}" required>
                            @error('tanggal_faktur')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="id_transaksi">
                                ID Transaksi
                            </label>
                            <select name="id_transaksi" id="id_transaksi" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('id_transaksi') border-red-500 @enderror"
                                required>
                                <option value="">Pilih ID Transaksi</option>
                                @foreach($barangMasuks as $barangMasuk)
                                    <option value="{{ $barangMasuk->id_transaksi }}" 
                                        data-nama="{{ $barangMasuk->barang }}"
                                        data-jumlah="{{ $barangMasuk->jumlah_masuk }}"
                                        data-satuan="{{ $barangMasuk->satuan }}">
                                        {{ $barangMasuk->id_transaksi }} - {{ $barangMasuk->barang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_transaksi')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_barang">
                                Nama Barang
                            </label>
                            <select name="nama_barang" id="nama_barang" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_barang') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Nama Barang</option>
                                @foreach($kelolaBarangs as $barang)
                                    <option value="{{ $barang->nama_barang }}" 
                                        data-jenis="{{ $barang->jenisBarang->nama_jenis ?? $barang->jenis_barang }}"
                                        data-satuan="{{ $barang->satuanBarang->nama_satuan ?? $barang->satuan }}"
                                        data-harga="{{ $barang->harga }}">
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_barang')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_barang">
                                Jenis Barang
                            </label>
                            <select name="jenis_barang" id="jenis_barang" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_barang') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenisBarangs as $jenis)
                                    <option value="{{ $jenis->nama_jenis }}">{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                            @error('jenis_barang')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="jumlah">
                                Jumlah
                            </label>
                            <input type="number" name="jumlah" id="jumlah" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jumlah') border-red-500 @enderror"
                                value="{{ old('jumlah') }}" required min="1">
                            @error('jumlah')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="satuan">
                                Satuan
                            </label>
                            <select name="satuan" id="satuan" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('satuan') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Satuan</option>
                                @foreach($satuans as $satuan)
                                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                                @endforeach
                            </select>
                            @error('satuan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_satuan">
                                Harga Satuan
                            </label>
                            <input type="number" name="harga_satuan" id="harga_satuan" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('harga_satuan') border-red-500 @enderror"
                                value="{{ old('harga_satuan') }}" required min="0" step="any">
                            @error('harga_satuan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="total_harga">
                                Total Harga
                            </label>
                            <input type="text" id="total_harga" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="keterangan">
                                Keterangan
                            </label>
                            <textarea name="keterangan" id="keterangan" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('keterangan') border-red-500 @enderror"
                                rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Faktur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-fill fields when selecting ID Transaksi
            const idTransaksiSelect = document.getElementById('id_transaksi');
            const namaBarangSelect = document.getElementById('nama_barang');
            const jenisBarangSelect = document.getElementById('jenis_barang');
            const satuanSelect = document.getElementById('satuan');
            const jumlahInput = document.getElementById('jumlah');
            const hargaSatuanInput = document.getElementById('harga_satuan');
            
            // When selecting a product name
            namaBarangSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Set jenis barang
                    const jenisBarang = selectedOption.dataset.jenis;
                    jenisBarangSelect.value = jenisBarang;
                    
                    // Set satuan
                    const satuan = selectedOption.dataset.satuan;
                    satuanSelect.value = satuan;
                    
                    // Set harga
                    const harga = selectedOption.dataset.harga;
                    hargaSatuanInput.value = harga;
                    
                    calculateTotal();
                }
            });

            // When selecting ID Transaksi
            idTransaksiSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Set nama barang
                    const namaBarang = selectedOption.dataset.nama;
                    namaBarangSelect.value = namaBarang;
                    
                    // Trigger nama barang change event to set other fields
                    const event = new Event('change');
                    namaBarangSelect.dispatchEvent(event);
                    
                    // Set jumlah
                    jumlahInput.value = selectedOption.dataset.jumlah || '';
                    calculateTotal();
                }
            });

            // Calculate total when changing jumlah or harga_satuan
            function calculateTotal() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
                const total = jumlah * hargaSatuan;
                document.getElementById('total_harga').value = total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            }

            jumlahInput.addEventListener('input', calculateTotal);
            hargaSatuanInput.addEventListener('input', calculateTotal);
        });
    </script>
    @endpush
</x-app-layout> 