<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\BarangMasuk;
use App\Models\KelolaBarang;
use App\Models\JenisBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FakturController extends Controller
{
    public function index()
    {
        $fakturs = Faktur::latest()->paginate(10);
        return view('faktur.index', compact('fakturs'));
    }

    public function create()
    {
        // Generate nomor faktur untuk ditampilkan di form (readonly)
        $nomorFaktur = Faktur::generateNomorFaktur();
        $barangMasuks = BarangMasuk::all();
        $kelolaBarangs = KelolaBarang::with(['jenisBarang', 'satuanBarang'])->get();
        $jenisBarangs = JenisBarang::all();
        $satuans = Satuan::all();
        
        return view('faktur.create', compact('nomorFaktur', 'barangMasuks', 'kelolaBarangs', 'jenisBarangs', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_faktur' => 'required|date',
            'id_transaksi' => 'required|exists:barang_masuks,id_transaksi',
            'nama_barang' => 'required|exists:kelola_barangs,nama_barang',
            'jenis_barang' => 'required|exists:jenis_barangs,nama_jenis',
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'required|exists:satuans,nama_satuan',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable'
        ]);

        // Nomor faktur akan di-generate otomatis oleh model
        $faktur = new Faktur($request->all());
        $faktur->total_harga = $request->jumlah * $request->harga_satuan;
        $faktur->save();

        return redirect()->route('adminbarang.faktur.index')
            ->with('success', 'Faktur berhasil dibuat.');
    }

    public function show(Faktur $faktur)
    {
        return view('faktur.show', compact('faktur'));
    }

    public function edit(Faktur $faktur)
    {
        $barangMasuks = BarangMasuk::all();
        $kelolaBarangs = KelolaBarang::with(['jenisBarang', 'satuanBarang'])->get();
        $jenisBarangs = JenisBarang::all();
        $satuans = Satuan::all();
        
        return view('faktur.edit', compact('faktur', 'barangMasuks', 'kelolaBarangs', 'jenisBarangs', 'satuans'));
    }

    public function update(Request $request, Faktur $faktur)
    {
        $request->validate([
            'tanggal_faktur' => 'required|date',
            'id_transaksi' => 'required|exists:barang_masuks,id_transaksi',
            'nama_barang' => 'required|exists:kelola_barangs,nama_barang',
            'jenis_barang' => 'required|exists:jenis_barangs,nama_jenis',
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'required|exists:satuans,nama_satuan',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable'
        ]);

        // Nomor faktur tidak diupdate karena bersifat tetap
        $data = $request->except('nomor_faktur');
        $data['total_harga'] = $request->jumlah * $request->harga_satuan;
        
        $faktur->update($data);

        return redirect()->route('adminbarang.faktur.index')
            ->with('success', 'Faktur berhasil diperbarui.');
    }

    public function destroy(Faktur $faktur)
    {
        $faktur->delete();
        return redirect()->route('adminbarang.faktur.index')
            ->with('success', 'Faktur berhasil dihapus.');
    }

    public function print(Faktur $faktur)
    {
        $pdf = PDF::loadView('faktur.print', compact('faktur'));
        return $pdf->stream('faktur-' . $faktur->nomor_faktur . '.pdf');
    }
} 