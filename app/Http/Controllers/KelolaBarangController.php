<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use Illuminate\Http\Request;

class KelolaBarangController extends Controller
{
    public function index()
    {
        $barangs = KelolaBarang::all();
        return view('superadmin.kelolabarang.index', compact('barangs'));
    }

    public function create()
    {
        return view('superadmin.kelolabarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
        ]);
        KelolaBarang::create($request->all());
        return redirect()->route('kelolabarang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)   
    {
        $barang = KelolaBarang::findOrFail($id);
        return view('superadmin.kelolabarang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
        ]);
        $barang = KelolaBarang::findOrFail($id);
        $barang->update($request->all());
        return redirect()->route('kelolabarang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = KelolaBarang::findOrFail($id);
        $barang->delete();
        return redirect()->route('kelolabarang.index')->with('success', 'Barang berhasil dihapus');
    }
}
