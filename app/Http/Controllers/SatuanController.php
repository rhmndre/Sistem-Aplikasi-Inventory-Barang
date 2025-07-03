<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::all();
        return view('satuan.index', compact('satuans'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang' => 'required|string|max:255',
        ]);
        Satuan::create($request->all());
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_barang' => 'required|string|max:255',
        ]);
        $satuan = Satuan::findOrFail($id);
        $satuan->update($request->all());
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil dihapus!');
    }
}
