<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('adminbarang.barangmasuk.store') }}" method="POST" id="barangMasukForm">
                        @csrf
                        <div class="grid gap-6">
                            <div>
                                <x-input-label for="id_transaksi" value="ID Transaksi" />
                                <x-text-input id="id_transaksi" name="id_transaksi" type="text" class="mt-1 block w-full"
                                    value="{{ $newTransactionId }}" readonly />
                            </div>

                            <div>
                                <x-input-label for="tanggal" value="Tanggal" />
                                <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full"
                                    value="{{ old('tanggal', date('Y-m-d')) }}" required />
                            </div>

                            <div id="barangContainer">
                                <!-- Template untuk baris barang -->
                                <div class="barang-row space-y-4 pb-4 mb-4 border-b border-gray-200">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-5">
                                            <x-input-label value="Nama Barang" />
                                            <select name="items[0][barang]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($kelolabarangs as $barang)
                                        <option value="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>

                                        <div class="col-span-3">
                                            <x-input-label value="Jumlah" />
                                            <x-text-input type="number" name="items[0][jumlah_masuk]" class="mt-1 block w-full" required min="1" />
                            </div>

                                        <div class="col-span-3">
                                            <x-input-label value="Satuan" />
                                            <select name="items[0][satuan]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($satuans as $satuan)
                                        <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                                        </div>

                                        <div class="col-span-1 flex items-end">
                                            <button type="button" class="remove-row text-red-600 hover:text-red-800" style="display: none;">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button type="button" id="addBarang" class="bg-blue-500">
                                    + Tambah Barang
                                </x-primary-button>
                                <x-primary-button type="submit">
                                    {{ __('Simpan') }}
                                </x-primary-button>
                                <a href="{{ route('adminbarang.barangmasuk.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Batal') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowCount = 0;
            const container = document.getElementById('barangContainer');
            const addButton = document.getElementById('addBarang');
            const template = container.querySelector('.barang-row').cloneNode(true);

            // Show remove button if there's more than one row
            function updateRemoveButtons() {
                const rows = container.querySelectorAll('.barang-row');
                rows.forEach(row => {
                    const removeBtn = row.querySelector('.remove-row');
                    removeBtn.style.display = rows.length > 1 ? 'block' : 'none';
                });
            }

            // Add new row
            addButton.addEventListener('click', function() {
                rowCount++;
                const newRow = template.cloneNode(true);
                
                // Update name attributes
                newRow.querySelectorAll('[name]').forEach(input => {
                    input.name = input.name.replace('[0]', `[${rowCount}]`);
                    input.value = ''; // Clear values
                });

                // Add remove button functionality
                const removeBtn = newRow.querySelector('.remove-row');
                removeBtn.addEventListener('click', function() {
                    newRow.remove();
                    updateRemoveButtons();
                });

                container.appendChild(newRow);
                updateRemoveButtons();
            });

            // Initialize remove buttons
            document.querySelectorAll('.remove-row').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.barang-row').remove();
                    updateRemoveButtons();
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
