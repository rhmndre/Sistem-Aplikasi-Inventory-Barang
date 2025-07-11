<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalBarang = KelolaBarang::count();
            $totalBarangMasuk = BarangMasuk::count();
            $totalBarangKeluar = BarangKeluar::count();
            
            // Ambil data barang dengan stok minimum (kurang dari atau sama dengan 10)
            $barangMinimum = KelolaBarang::where('stok', '<=', 10)->count();
            $stokMinimum = KelolaBarang::where('stok', '<=', 10)
                ->with(['jenisBarang', 'satuan'])
                ->get();

            // Ambil data barang masuk dan keluar terbaru
            $barangMasukTerbaru = BarangMasuk::with(['kelolaBarang'])
                ->latest()
                ->take(5)
                ->get();

            $barangKeluarTerbaru = BarangKeluar::with(['kelolaBarang'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard', compact(
                'totalBarang',
                'totalBarangMasuk',
                'totalBarangKeluar',
                'barangMinimum',
                'stokMinimum',
                'barangMasukTerbaru',
                'barangKeluarTerbaru'
            ));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
