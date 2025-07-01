<?php
namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\User;
use App\Models\JenisBarang;
use App\Models\Satuan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'jumlahBarang' => KelolaBarang::count(),
            'jumlahBarangMasuk' => BarangMasuk::count(),
            'jumlahBarangKeluar' => BarangKeluar::count(),
            'jumlahUser' => User::count(),
            'jumlahJenisBarang' => JenisBarang::count(),
            'jumlahSatuan' => Satuan::count(),
            'barangMinimum' => KelolaBarang::where('stok', '<=', 5)->get() // ambil barang dengan stok minimum
        ]);
    }
}
