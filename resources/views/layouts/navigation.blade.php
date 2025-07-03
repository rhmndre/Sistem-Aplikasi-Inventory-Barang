<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Sidebar -->
<aside class="w-64 bg-white text-gray-800 flex flex-col min-h-screen shadow-lg">
    <!-- Logo -->
    <div class="flex items-center gap-2 justify-center h-16 bg-[#6C63FF] border-b border-[#6C63FF]">
        <span class="text-3xl font-bold text-yellow-400">PMAR</span>
        <span class="text-xl font-semibold text-white">MATERIAL</span>
    </div>

    <!-- Menu Utama -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg font-semibold text-white bg-[#6C63FF] shadow">
            <i class="fas fa-home w-5 h-5"></i>
            Dashboard
        </a>

        @if(Auth::user()->role === 'superadmin')
            <!-- Master -->
            <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Master</div>

            <a href="{{ route('superadmin.kelolabarang.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-box w-5 h-5"></i>
                Barang
            </a>

            <a href="{{ route('superadmin.jenisbarang.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-tags w-5 h-5"></i>
                Jenis Barang
            </a>

            <a href="{{ route('superadmin.satuan.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-balance-scale w-5 h-5"></i>
                Satuan
            </a>

            <!-- Pengaturan -->
            <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Pengaturan</div>

            <a href="{{ route('superadmin.manajemenuser.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-users-cog w-5 h-5"></i>
                Manajemen User
            </a>
        @endif

        @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'adminbarang')
            <!-- Transaksi -->
            <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Transaksi</div>

            <a href="{{ route('superadmin.barangmasuk.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-arrow-down w-5 h-5"></i>
                Barang Masuk
            </a>

            <a href="{{ route('superadmin.barangkeluar.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-arrow-up w-5 h-5"></i>
                Barang Keluar
            </a>
        @endif
        
        <!-- Laporan -->
        <div class="mt-6 mb-2 text-xs font-bold text-gray-500 uppercase">Laporan</div>

        <a href="{{ route('laporan.stok') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
            <i class="fas fa-chart-line w-5 h-5"></i>
            Laporan Stok
        </a>
        @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'kepalagudang')
        
        <a href="{{ route('laporan.barangmasuk') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
            <i class="fas fa-file-import w-5 h-5"></i>
            Laporan Barang Masuk
        </a>

        <a href="{{ route('laporan.barangkeluar') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
            <i class="fas fa-file-export w-5 h-5"></i>
            Laporan Barang Keluar
        </a>
        @endif
    </nav>

    <!-- Footer -->
    <div class="border-t border-gray-200 p-4">
        <div class="mb-2 font-semibold">{{ Auth::user()->name }}</div>
        <div class="mb-4 text-sm text-gray-500">{{ Auth::user()->email }}</div>
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
            <i class="fas fa-user-edit mr-2"></i> Profile
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </button>
        </form>
    </div>
</aside>
