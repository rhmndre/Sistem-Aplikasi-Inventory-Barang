<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Sidebar -->
<aside class="w-64 bg-white text-gray-800 flex flex-col min-h-screen shadow-lg transition-all duration-300 ease-in-out">
    <!-- Logo -->
    <div class="flex items-center justify-start h-24 bg-gradient-to-r from-purple-600 to-indigo-600 border-b border-indigo-700 p-4 gap-3">
        <img src="{{ asset('mahkota.png') }}" alt="Logo PAMR" class="h-16 w-auto transform hover:scale-105 transition-transform duration-300">
        <span class="text-white font-semibold leading-tight" style="font-size: 0.8rem;">
            PT PIONER AURA<br>MUSTIKA RAYA
        </span>
    </div>

    <!-- Menu Utama -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
            <i class="fas fa-home w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'adminbarang')
            <!-- Master -->
            <div class="mt-6 mb-3 text-xs font-bold text-gray-500 uppercase tracking-wider px-3">Master</div>
            
            <a href="{{ route('adminbarang.kelolabarang.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.kelolabarang.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-box w-5 h-5"></i>
                <span>Barang</span>
            </a>

            <a href="{{ route('adminbarang.jenisbarang.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.jenisbarang.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-tags w-5 h-5"></i>
                <span>Jenis Barang</span>
            </a>

            <a href="{{ route('adminbarang.satuan.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.satuan.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-balance-scale w-5 h-5"></i>
                <span>Satuan</span>
            </a>

         
        @endif

        @if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'adminbarang')
            <!-- Transaksi -->
            <div class="mt-6 mb-3 text-xs font-bold text-gray-500 uppercase tracking-wider px-3">Transaksi</div>

            <a href="{{ route('adminbarang.barangmasuk.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.barangmasuk.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-arrow-down w-5 h-5"></i>
                <span>Barang Masuk</span>
            </a>

            <a href="{{ route('adminbarang.barangkeluar.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.barangkeluar.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-arrow-up w-5 h-5"></i>
                <span>Barang Keluar</span>
            </a>

            <a href="{{ route('adminbarang.faktur.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.faktur.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-file-invoice w-5 h-5"></i>
                <span>Faktur</span>
            </a>
        @endif

        <!-- Laporan -->
        <div class="mt-6 mb-3 text-xs font-bold text-gray-500 uppercase tracking-wider px-3">Laporan</div>
        @if (Auth::user()->role === 'superadmin' ||Auth::user()->role === 'kepalagudang' || Auth::user()->role === 'adminbarang')
            <a href="{{ route('laporan.stok') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('laporan.stok') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-chart-line w-5 h-5"></i>
                <span>Laporan Stok</span>
            </a>
        @endif

        @if (Auth::user()->role === 'superadmin'||Auth::user()->role === 'adminbarang'|| Auth::user()->role === 'kepalagudang')
            <a href="{{ route('laporan.barangmasuk') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('laporan.barangmasuk') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-file-import w-5 h-5"></i>
                <span>Laporan Barang Masuk</span>
            </a>

            <a href="{{ route('laporan.barangkeluar') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('laporan.barangkeluar') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                <i class="fas fa-file-export w-5 h-5"></i>
                <span>Laporan Barang Keluar</span>
            </a>
        @endif

        {{-- Manajemen --}}
        @if (Auth::user()->role === 'superadmin')
        <div class="mt-6 mb-3 text-xs font-bold text-gray-500 uppercase tracking-wider px-3">Manajemen</div>
        <a href="{{ route('superadmin.manajemenuser.index') }}"
            class="flex items-center gap-2 px-3 py-2.5 rounded-lg font-medium {{ request()->routeIs('adminbarang.manajemenuser.*') ? 'text-white bg-gradient-to-r from-purple-600 to-indigo-600 shadow-md' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
            <i class="fas fa-users w-5 h-5"></i>
            <span>Manajemen User</span>
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
