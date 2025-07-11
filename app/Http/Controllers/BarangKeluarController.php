<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\KelolaBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangkeluars = BarangKeluar::all();
        return view('barangkeluar.index', compact('barangkeluars'));
    }

    public function create()
    {
        $kelolabarangs = KelolaBarang::all();
        $satuans = Satuan::all();
        return view('barangkeluar.create', compact('kelolabarangs', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_keluars,id_transaksi',
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_keluar' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        BarangKeluar::create($request->all());
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.edit', compact('barangkeluar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_keluars,id_transaksi,' . $id,
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_keluar' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->update($request->all());
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil dihapus!');
    }
}
