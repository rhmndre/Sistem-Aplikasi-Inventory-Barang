<?php

namespace App\Http\Controllers;

use App\Models\KelolaBarang;
use App\Models\Satuan;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelolaBarangController extends Controller
{
    public function index()
    {
        $barangs = KelolaBarang::with(['satuanBarang', 'jenisBarang'])->get();
        return view('kelolabarang.index', compact('barangs'));
    }

    public function show($id)
    {
        $barang = KelolaBarang::with(['satuanBarang', 'jenisBarang'])->findOrFail($id);
        return view('kelolabarang.show', compact('barang'));
    }

    public function create()
    {
        $satuans = Satuan::all();
        $jenisBarangs = JenisBarang::all();
        return view('kelolabarang.create', compact('satuans', 'jenisBarangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|exists:jenis_barangs,nama_jenis',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|exists:satuans,nama_satuan',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $data = $request->except('foto');

        // Generate kode barang berdasarkan jenis
        $jenis = JenisBarang::where('nama_jenis', $request->jenis_barang)->first();
        $prefix = '';
        switch($jenis->nama_jenis) {
            case 'Pupuk':
                $prefix = 'PPK';
                break;
            case 'Bibit':
                $prefix = 'BBT';
                break;
            case 'Produk Stunting':
                $prefix = 'STN';
                break;
            case 'Vaksin Ternak':
                $prefix = 'VKS';
                break;
            default:
                $prefix = 'BRG';
        }
        
        // Hitung jumlah barang dengan prefix yang sama
        $count = KelolaBarang::where('kode_barang', 'like', $prefix.'%')->count();
        $data['kode_barang'] = $prefix . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Upload dan konversi foto ke BLOB jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $data['foto'] = file_get_contents($foto->getRealPath());
        }

        KelolaBarang::create($data);

        return redirect()->route('adminbarang.kelolabarang.index')
            ->with('success', 'Data barang berhasil ditambahkan');
    }

    public function edit($id)   
    {
        $barang = KelolaBarang::findOrFail($id);
        $satuans = Satuan::all();
        $jenisBarangs = JenisBarang::all();
        return view('kelolabarang.edit', compact('barang', 'satuans', 'jenisBarangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|exists:jenis_barangs,nama_jenis',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|exists:satuans,nama_satuan',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $barang = KelolaBarang::findOrFail($id);
        $data = $request->except('foto');

        // Upload dan konversi foto ke BLOB jika ada foto baru
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $data['foto'] = file_get_contents($foto->getRealPath());
        }

        $barang->update($data);
        return redirect()->route('adminbarang.kelolabarang.index')
            ->with('success', 'Data barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = KelolaBarang::findOrFail($id);
        $barang->delete();
        return redirect()->route('adminbarang.kelolabarang.index')
            ->with('success', 'Data barang berhasil dihapus');
    }

    // Method baru untuk menampilkan foto
    public function showFoto($id)
    {
        $barang = KelolaBarang::findOrFail($id);
        if ($barang->foto) {
            return response($barang->foto)
                ->header('Content-Type', 'image/jpeg');
        }
        abort(404);
    }
}
