<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangmasuks = BarangMasuk::all();
        return view('barangmasuk.index', compact('barangmasuks'));
    }

    public function create()
    {
        return view('barangmasuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_masuks,id_transaksi',
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'jumlah_masuk' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        BarangMasuk::create($request->all());
        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.edit', compact('barangmasuk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_masuks,id_transaksi,' . $id,
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'jumlah_masuk' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->update($request->all());
        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus!');
    }
}
