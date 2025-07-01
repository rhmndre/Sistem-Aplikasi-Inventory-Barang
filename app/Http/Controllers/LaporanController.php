<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function stok()
    {
        // Tampilkan view laporan stok
        return view('laporan.stok');
    }

    public function barangMasuk()
    {
        // Tampilkan view laporan barang masuk
        return view('laporan.barangmasuk');
    }

    public function barangKeluar()
    {
        // Tampilkan view laporan barang keluar
        return view('laporan.barangkeluar');
    }
}
