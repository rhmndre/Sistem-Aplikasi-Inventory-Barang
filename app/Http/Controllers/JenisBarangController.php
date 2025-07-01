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
            'jenis_barang' => 'required|string|max:255',
        ]);
        JenisBarang::create($request->only('jenis_barang'));
        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil ditambahkan.');
    }

    public function edit(JenisBarang $jenisbarang)
    {
        return view('jenisbarang.edit', compact('jenisbarang'));
    }

    public function update(Request $request, JenisBarang $jenisbarang)
    {
        $request->validate([
            'jenis_barang' => 'required|string|max:255',
        ]);
        $jenisbarang->update($request->only('jenis_barang'));
        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil diupdate.');
    }

    public function destroy(JenisBarang $jenisbarang)
    {
        $jenisbarang->delete();
        return redirect()->route('jenisbarang.index')->with('success', 'Jenis barang berhasil dihapus.');
    }
}
