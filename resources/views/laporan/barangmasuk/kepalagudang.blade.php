<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Barang Masuk - Kepala Gudang') }}
            </h2>
            <div class="flex space-x-2">
                <button id="exportBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <button id="printBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-print mr-2"></i>Print
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Statistics Cards with Warehouse Perspective -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-truck-loading text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Barang Masuk</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_qty']) }} Unit</p>
                            <p class="text-sm text-gray-500">{{ $stats['total_transaksi'] }} Transaksi</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-warehouse text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Nilai Gudang</h3>
                            <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">Data Terverifikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Warehouse Dashboard -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Dashboard Gudang</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button onclick="showOperationalReport()" class="bg-blue-500 text-white py-3 px-4 rounded hover:bg-blue-600">
                        <i class="fas fa-chart-line mr-2"></i>
                        <div class="text-sm">Laporan Operasional</div>
                        <div class="text-xs">Hari ini & Minggu ini</div>
                    </button>
                    <button onclick="showInventoryTrend()" class="bg-purple-500 text-white py-3 px-4 rounded hover:bg-purple-600">
                        <i class="fas fa-chart-bar mr-2"></i>
                        <div class="text-sm">Trend Inventori</div>
                        <div class="text-xs">Analisis bulanan</div>
                    </button>
                    <button onclick="showSupplierAnalysis()" class="bg-green-500 text-white py-3 px-4 rounded hover:bg-green-600">
                        <i class="fas fa-truck mr-2"></i>
                        <div class="text-sm">Analisis Supplier</div>
                        <div class="text-xs">Performa pengiriman</div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters for Warehouse View -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Laporan</h3>
                <form method="GET" action="{{ route('laporan.barangmasuk') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <i class="fas fa-search mr-2"></i>Filter Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Warehouse Summary Table -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Data Penerimaan Barang</h3>
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ $barangMasuks->count() }} dari {{ $barangMasuks->total() }} data
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty Diterima</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($barangMasuks as $index => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ ($barangMasuks->currentPage() - 1) * $barangMasuks->perPage() + $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-medium">{{ $item->tanggal->format('d/m/Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->tanggal->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $item->id_transaksi }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium">{{ $item->barang }}</div>
                                                @if($item->keterangan)
                                                    <div class="text-xs text-gray-500 max-w-xs truncate">{{ $item->keterangan }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center">
                                                <i class="fas fa-truck text-gray-400 mr-2"></i>
                                                {{ $item->supplier ?? 'Tidak ada data' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="text-center">
                                                <div class="text-lg font-bold text-blue-600">{{ number_format($item->jumlah_masuk) }}</div>
                                                <div class="text-xs text-gray-500">{{ $item->satuan }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($item->total_harga)
                                                <div class="text-right">
                                                    <div class="font-medium">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        @if($item->harga_satuan)
                                                            @ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $item->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                <i class="fas {{ $item->status === 'approved' ? 'fa-check' : ($item->status === 'pending' ? 'fa-clock' : 'fa-times') }} mr-1"></i>
                                                {{ $item->status_label }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-indigo-600 hover:text-indigo-900" onclick="viewWarehouseDetail({{ $item->id }})" title="Detail Gudang">
                                                    <i class="fas fa-warehouse"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-900" onclick="printReceiptWarehouse({{ $item->id }})" title="Print Surat Terima">
                                                    <i class="fas fa-receipt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                            <i class="fas fa-inbox text-4xl text-gray-300 mb-4 block"></i>
                                            <div class="text-lg">Tidak ada data penerimaan barang</div>
                                            <div class="text-sm">Silakan periksa filter tanggal atau hubungi admin</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $barangMasuks->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Warehouse Summary Footer -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Gudang</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                        <div class="text-2xl font-bold text-blue-600">{{ $stats['total_transaksi'] }}</div>
                        <div class="text-sm text-blue-600">Total Penerimaan</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
                        <div class="text-sm text-green-600">Sudah Diverifikasi</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                        <div class="text-2xl font-bold text-purple-600">{{ number_format($stats['total_qty']) }}</div>
                        <div class="text-sm text-purple-600">Total Unit Masuk</div>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                        <div class="text-lg font-bold text-yellow-600">
                            Rp {{ number_format($stats['total_nilai']/1000000, 1) }}M
                        </div>
                        <div class="text-sm text-yellow-600">Nilai Inventori</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Export Options -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Export Laporan Gudang</h3>
                <div class="mt-4 px-7 py-3">
                    <button onclick="exportData('excel')" class="w-full mb-3 bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                        <i class="fas fa-file-excel mr-2"></i>Export ke Excel
                    </button>
                    <button onclick="exportData('pdf')" class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                        <i class="fas fa-file-pdf mr-2"></i>Export ke PDF
                    </button>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="closeExportModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Export Modal Functions
        function showExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }
        
        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }
        
        function exportData(format) {
            const params = new URLSearchParams(window.location.search);
            params.set('format', format);
            window.open(`{{ route('laporan.barangmasuk.export') }}?${params.toString()}`, '_blank');
            closeExportModal();
        }
        
        // Warehouse Specific Functions
        function showOperationalReport() {
            const today = new Date().toISOString().split('T')[0];
            const weekAgo = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
            window.location.href = `{{ route('laporan.barangmasuk') }}?start_date=${weekAgo}&end_date=${today}`;
        }
        
        function showInventoryTrend() {
            const today = new Date();
            const monthAgo = new Date(today.getFullYear(), today.getMonth() - 1, 1).toISOString().split('T')[0];
            const endMonth = new Date(today.getFullYear(), today.getMonth(), 0).toISOString().split('T')[0];
            window.location.href = `{{ route('laporan.barangmasuk') }}?start_date=${monthAgo}&end_date=${endMonth}`;
        }
        
        function showSupplierAnalysis() {
            // Implementasi analisis supplier
            alert('Fitur analisis supplier akan segera tersedia');
        }
        
        function viewWarehouseDetail(id) {
            // Implementasi view detail khusus gudang
            alert('Detail gudang untuk ID: ' + id);
        }
        
        function printReceiptWarehouse(id) {
            // Implementasi print surat terima gudang
            alert('Print surat terima untuk ID: ' + id);
        }
        
        // Event Listeners
        document.getElementById('exportBtn').addEventListener('click', showExportModal);
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });
    </script>
</x-app-layout>