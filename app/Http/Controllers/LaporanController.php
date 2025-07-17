<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelolaBarang;
use App\Models\Satuan;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function stok(Request $request)
    {
        $filter = $request->input('filter');
        $data = [];
        
        if ($filter === 'all' || $filter === 'minimum') {
            $query = KelolaBarang::with(['satuan', 'jenisBarang']);

            if ($filter === 'minimum') {
                $query->whereRaw('stok <= minimum');
            }

            $data = $query->get();
            
            // Transform data untuk view
            $data = $data->map(function($item) {
                return [
                    'id_barang' => $item->id_barang,
                    'nama_barang' => $item->nama_barang,
                    'stok' => $item->stok,
                    'minimum' => $item->minimum,
                    'jenis_barang' => $item->jenisBarang->nama_jenis,
                    'satuan' => $item->satuan->nama_satuan
                ];
            });
        }

        return view('laporan.stok', compact('data', 'filter'));
    }

    public function stokPdf(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $data = [];
        
        if ($filter === 'all' || $filter === 'minimum') {
            $query = KelolaBarang::with(['satuan', 'jenisBarang']);

            if ($filter === 'minimum') {
                $query->whereRaw('stok <= minimum');
            }

            $data = $query->get();
            
            // Transform data untuk view
            $data = $data->map(function($item) {
                return [
                    'id_barang' => $item->id_barang,
                    'nama_barang' => $item->nama_barang,
                    'stok' => $item->stok,
                    'minimum' => $item->minimum,
                    'jenis_barang' => $item->jenisBarang->nama_jenis,
                    'satuan' => $item->satuan->nama_satuan
                ];
            });
        }

        $pdf = PDF::loadView('laporan.stok-pdf', compact('data', 'filter'));
        return $pdf->download('laporan-stok.pdf');
    }

    public function barangMasuk(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = BarangMasuk::with(['kelolaBarang' => function($q) {
            $q->with('satuanBarang');
        }])->orderBy('tanggal', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $data = $query->get();

        return view('laporan.barangmasuk', compact('data', 'startDate', 'endDate'));
    }

    public function barangMasukPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = BarangMasuk::with(['kelolaBarang.satuan'])
            ->orderBy('tanggal', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $data = $query->get();

        $pdf = PDF::loadView('laporan.barangmasuk-pdf', compact('data', 'startDate', 'endDate'));
        return $pdf->download('laporan-barang-masuk.pdf');
    }

    public function barangKeluar(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = BarangKeluar::with(['kelolaBarang' => function($q) {
            $q->with('satuanBarang');
        }])->orderBy('tanggal', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $data = $query->get();

        return view('laporan.barangkeluar', compact('data', 'startDate', 'endDate'));
    }

    public function barangKeluarPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = BarangKeluar::with(['kelolaBarang.satuan'])
            ->orderBy('tanggal', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $data = $query->get();

        $pdf = PDF::loadView('laporan.barangkeluar-pdf', compact('data', 'startDate', 'endDate'));
        return $pdf->download('laporan-barang-keluar.pdf');
    }
}
