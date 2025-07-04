<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\KelolaBarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function stok()
    {
        // Tampilkan view laporan stok
        return view('laporan.stok');
    }

    public function barangMasuk(Request $request)
    {
        $user = Auth::user();
        $role = $user->role ?? 'user';
        
        // Base query
        $query = BarangMasuk::with(['approvedBy', 'createdBy']);
        
        // Filter berdasarkan parameter request
        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('supplier')) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }
        
        if ($request->filled('barang')) {
            $query->where('barang', 'like', '%' . $request->barang . '%');
        }
        
        // Filter berdasarkan role
        switch ($role) {
            case 'superadmin':
                // Superadmin dapat melihat semua data
                break;
            case 'adminbarang':
                // Admin barang dapat melihat data yang sudah disetujui dan yang dia buat
                $query->where(function($q) use ($user) {
                    $q->where('status', 'approved')
                      ->orWhere('created_by', $user->id);
                });
                break;
            case 'kepalagudang':
                // Kepala gudang dapat melihat semua data yang sudah disetujui
                $query->where('status', 'approved');
                break;
            default:
                // Role lain hanya dapat melihat data yang mereka buat
                $query->where('created_by', $user->id);
                break;
        }
        
        // Urutkan berdasarkan tanggal terbaru
        $query->orderBy('tanggal', 'desc');
        
        $barangMasuks = $query->paginate(20);
        
        // Hitung statistik untuk dashboard
        $stats = $this->getStatistikBarangMasuk($request, $role, $user);
        
        // Return view berdasarkan role
        $viewName = $this->getViewNameByRole($role, 'barangmasuk');
        
        return view($viewName, compact('barangMasuks', 'stats', 'role'));
    }

    public function barangKeluar()
    {
        // Tampilkan view laporan barang keluar
        return view('laporan.barangkeluar');
    }

    /**
     * Export laporan barang masuk ke Excel/PDF
     */
    public function exportBarangMasuk(Request $request)
    {
        $user = Auth::user();
        $role = $user->role ?? 'user';
        
        // Query data sesuai filter dan role
        $query = BarangMasuk::with(['approvedBy', 'createdBy']);
        
        // Terapkan filter yang sama seperti di method barangMasuk
        if ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan role
        switch ($role) {
            case 'superadmin':
                break;
            case 'adminbarang':
                $query->where(function($q) use ($user) {
                    $q->where('status', 'approved')
                      ->orWhere('created_by', $user->id);
                });
                break;
            case 'kepalagudang':
                $query->where('status', 'approved');
                break;
            default:
                $query->where('created_by', $user->id);
                break;
        }
        
        $barangMasuks = $query->orderBy('tanggal', 'desc')->get();
        
        // Generate file berdasarkan format yang diminta
        $format = $request->get('format', 'excel');
        
        if ($format === 'pdf') {
            return $this->exportToPdf($barangMasuks, $role);
        } else {
            return $this->exportToExcel($barangMasuks, $role);
        }
    }

    /**
     * Mendapatkan statistik barang masuk
     */
    private function getStatistikBarangMasuk($request, $role, $user)
    {
        $baseQuery = BarangMasuk::query();
        
        // Terapkan filter role
        switch ($role) {
            case 'superadmin':
                break;
            case 'adminbarang':
                $baseQuery->where(function($q) use ($user) {
                    $q->where('status', 'approved')
                      ->orWhere('created_by', $user->id);
                });
                break;
            case 'kepalagudang':
                $baseQuery->where('status', 'approved');
                break;
            default:
                $baseQuery->where('created_by', $user->id);
                break;
        }
        
        // Terapkan filter tanggal jika ada
        if ($request->filled('start_date')) {
            $baseQuery->where('tanggal', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $baseQuery->where('tanggal', '<=', $request->end_date);
        }
        
        return [
            'total_transaksi' => $baseQuery->count(),
            'total_nilai' => $baseQuery->sum('total_harga'),
            'total_qty' => $baseQuery->sum('jumlah_masuk'),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];
    }

    /**
     * Mendapatkan nama view berdasarkan role
     */
    private function getViewNameByRole($role, $type)
    {
        $roleViews = [
            'superadmin' => "laporan.{$type}.superadmin",
            'adminbarang' => "laporan.{$type}.adminbarang", 
            'kepalagudang' => "laporan.{$type}.kepalagudang",
        ];
        
        return $roleViews[$role] ?? "laporan.{$type}.default";
    }

    /**
     * Export ke Excel (placeholder - implementasikan dengan package seperti Maatwebsite/Excel)
     */
    private function exportToExcel($data, $role)
    {
        // Implementasi export Excel
        // return Excel::download(new BarangMasukExport($data, $role), 'laporan-barang-masuk.xlsx');
        
        // Sementara return response JSON
        return response()->json([
            'message' => 'Export Excel akan diimplementasikan dengan package Maatwebsite/Excel',
            'data_count' => $data->count(),
            'role' => $role
        ]);
    }

    /**
     * Export ke PDF (placeholder - implementasikan dengan package seperti DomPDF)
     */
    private function exportToPdf($data, $role)
    {
        // Implementasi export PDF
        // $pdf = PDF::loadView('laporan.barangmasuk.pdf', compact('data', 'role'));
        // return $pdf->download('laporan-barang-masuk.pdf');
        
        // Sementara return response JSON
        return response()->json([
            'message' => 'Export PDF akan diimplementasikan dengan package DomPDF/Snappy',
            'data_count' => $data->count(),
            'role' => $role
        ]);
    }

    /**
     * API untuk mendapatkan data grafik/chart
     */
    public function getChartData(Request $request)
    {
        $user = Auth::user();
        $role = $user->role ?? 'user';
        
        $period = $request->get('period', 'monthly'); // monthly, weekly, yearly
        
        $query = BarangMasuk::query();
        
        // Filter berdasarkan role
        switch ($role) {
            case 'superadmin':
                break;
            case 'adminbarang':
                $query->where(function($q) use ($user) {
                    $q->where('status', 'approved')
                      ->orWhere('created_by', $user->id);
                });
                break;
            case 'kepalagudang':
                $query->where('status', 'approved');
                break;
            default:
                $query->where('created_by', $user->id);
                break;
        }
        
        if ($period === 'monthly') {
            $data = $query->selectRaw('MONTH(tanggal) as month, COUNT(*) as count, SUM(total_harga) as total')
                         ->whereYear('tanggal', Carbon::now()->year)
                         ->groupBy('month')
                         ->orderBy('month')
                         ->get();
        } else {
            // Implementasi untuk periode lain
            $data = collect();
        }
        
        return response()->json($data);
    }
}
