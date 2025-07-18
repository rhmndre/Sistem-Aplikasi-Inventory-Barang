<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarangs = JenisBarang::all();
        return view('jenisbarang.index', compact('jenisBarangs'));
    }

    public function create()
    {
        return view('jenisbarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_barangs',
        ]);
        
        JenisBarang::firstOrCreate($request->only([
            'nama_jenis', 
            'keterangan'
        ]));
        return redirect()->route('adminbarang.jenisbarang.index')->with('success', 'Jenis barang berhasil ditambahkan.');
    }

    public function show(JenisBarang $jenisbarang)
    {
        return view('jenisbarang.show', compact('jenisbarang'));
    }

    public function edit(JenisBarang $jenisbarang)
    {
        return view('jenisbarang.edit', compact('jenisbarang'));
    }

    public function update(Request $request, JenisBarang $jenisbarang)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_barangs,nama_jenis,'.$jenisbarang->id,
        ]);
        
        $jenisbarang->update($request->only('nama_jenis'));
        return redirect()->route('adminbarang.jenisbarang.index')->with('success', 'Jenis barang berhasil diupdate.');
    }

    public function destroy(JenisBarang $jenisbarang)
    {
        $jenisbarang->delete();
        return redirect()->route('adminbarang.jenisbarang.index')->with('success', 'Jenis barang berhasil dihapus.');
    }
}
