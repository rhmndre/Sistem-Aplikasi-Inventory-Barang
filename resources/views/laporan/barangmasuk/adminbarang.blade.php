<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Barang Masuk - Admin Barang') }}
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
        <!-- Statistics Cards -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-chart-bar text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Transaksi</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_transaksi']) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-money-bill-wave text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Nilai</h3>
                            <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                            <i class="fas fa-boxes text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Qty</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_qty']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions for Admin Barang -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <button onclick="showTodayReport()" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        <i class="fas fa-calendar-day mr-2"></i>Laporan Hari Ini
                    </button>
                    <button onclick="showWeeklyReport()" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                        <i class="fas fa-calendar-week mr-2"></i>Laporan Mingguan
                    </button>
                    <button onclick="showMonthlyReport()" class="bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600">
                        <i class="fas fa-calendar-alt mr-2"></i>Laporan Bulanan
                    </button>
                    <button onclick="showApprovedOnly()" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
                        <i class="fas fa-check-circle mr-2"></i>Data Disetujui
                    </button>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Data</h3>
                <form method="GET" action="{{ route('laporan.barangmasuk') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    
                    <div>
                        <label for="supplier" class="block text-sm font-medium text-gray-700">Supplier</label>
                        <input type="text" id="supplier" name="supplier" value="{{ request('supplier') }}" 
                               placeholder="Nama supplier..." 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <i class="fas fa-search mr-2"></i>Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Data Barang Masuk</h3>
                        <div class="text-sm text-gray-500">
                            Total: {{ $barangMasuks->total() }} item
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->id_transaksi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->tanggal->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div>
                                                <div class="font-medium">{{ $item->barang }}</div>
                                                @if($item->keterangan)
                                                    <div class="text-xs text-gray-500">{{ $item->keterangan }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->supplier ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="font-medium">{{ number_format($item->jumlah_masuk) }}</span> {{ $item->satuan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($item->harga_satuan)
                                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($item->total_harga)
                                                <span class="font-medium">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $item->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-indigo-600 hover:text-indigo-900" onclick="viewDetail({{ $item->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-900" onclick="printItem({{ $item->id }})">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data barang masuk
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

        <!-- Summary Section untuk Admin Barang -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ringkasan Status</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
                        <div class="text-sm text-yellow-600">Menunggu Persetujuan</div>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
                        <div class="text-sm text-green-600">Telah Disetujui</div>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <div class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</div>
                        <div class="text-sm text-red-600">Ditolak</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Export Options -->
    <div id="exportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Export Laporan</h3>
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
        
        // Quick Filter Functions
        function showTodayReport() {
            const today = new Date().toISOString().split('T')[0];
            window.location.href = `{{ route('laporan.barangmasuk') }}?start_date=${today}&end_date=${today}`;
        }
        
        function showWeeklyReport() {
            const today = new Date();
            const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
            const startDate = weekAgo.toISOString().split('T')[0];
            const endDate = today.toISOString().split('T')[0];
            window.location.href = `{{ route('laporan.barangmasuk') }}?start_date=${startDate}&end_date=${endDate}`;
        }
        
        function showMonthlyReport() {
            const today = new Date();
            const monthAgo = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
            const startDate = monthAgo.toISOString().split('T')[0];
            const endDate = today.toISOString().split('T')[0];
            window.location.href = `{{ route('laporan.barangmasuk') }}?start_date=${startDate}&end_date=${endDate}`;
        }
        
        function showApprovedOnly() {
            window.location.href = `{{ route('laporan.barangmasuk') }}?status=approved`;
        }
        
        // Action Functions
        function viewDetail(id) {
            // Implementasi view detail
            alert('View detail for ID: ' + id);
        }
        
        function printItem(id) {
            // Implementasi print item individual
            alert('Print item ID: ' + id);
        }
        
        // Event Listeners
        document.getElementById('exportBtn').addEventListener('click', showExportModal);
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });
    </script>
</x-app-layout>