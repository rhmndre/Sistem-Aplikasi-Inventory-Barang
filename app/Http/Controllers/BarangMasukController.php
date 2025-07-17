<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\KelolaBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangmasuks = BarangMasuk::all();
        return view('barangmasuk.index', compact('barangmasuks'));
    }

    public function create()
    {
        // Generate ID Transaksi secara otomatis
        $lastTransaction = BarangMasuk::orderBy('id_transaksi', 'desc')->first();
        $prefix = 'TRX-BM-' . date('Ymd');
        
        if ($lastTransaction && str_starts_with($lastTransaction->id_transaksi, $prefix)) {
            $lastNumber = (int) substr($lastTransaction->id_transaksi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        $newTransactionId = $prefix . $newNumber;
        
        $kelolabarangs = KelolaBarang::all();
        $satuans = Satuan::all();
        return view('barangmasuk.create', compact('kelolabarangs', 'satuans', 'newTransactionId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_masuks,id_transaksi',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.barang' => 'required|string|exists:kelola_barangs,nama_barang',
            'items.*.jumlah_masuk' => 'required|integer|min:1',
            'items.*.satuan' => 'required|string|exists:satuans,nama_satuan',
        ], [
            'id_transaksi.required' => 'ID Transaksi wajib diisi.',
            'id_transaksi.unique' => 'ID Transaksi sudah digunakan.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'items.required' => 'Minimal satu barang harus diinput.',
            'items.*.barang.required' => 'Nama barang wajib diisi.',
            'items.*.barang.exists' => 'Nama barang tidak ditemukan.',
            'items.*.jumlah_masuk.required' => 'Jumlah masuk wajib diisi.',
            'items.*.jumlah_masuk.integer' => 'Jumlah masuk harus berupa angka.',
            'items.*.jumlah_masuk.min' => 'Jumlah masuk minimal 1.',
            'items.*.satuan.required' => 'Satuan wajib diisi.',
            'items.*.satuan.exists' => 'Satuan tidak ditemukan.',
        ]);

        try {
            DB::beginTransaction();

            // Format: TRX-BM-YYYYMMDD0001 (format ID Transaksi)
            if (!str_starts_with($request->id_transaksi, 'TRX-BM-')) {
                $prefix = 'TRX-BM-' . date('Ymd');
                $lastTransaction = BarangMasuk::where('id_transaksi', 'like', $prefix . '%')
                    ->orderBy('id_transaksi', 'desc')
                    ->first();

                if ($lastTransaction) {
                    $lastNumber = (int) substr($lastTransaction->id_transaksi, -4);
                    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = '0001';
                }
                
                $request->merge(['id_transaksi' => $prefix . $newNumber]);
            }

            // Simpan setiap item barang masuk
            foreach ($request->items as $item) {
                BarangMasuk::create([
                    'id_transaksi' => $request->id_transaksi,
                    'tanggal' => $request->tanggal,
                    'barang' => $item['barang'],
                    'jumlah_masuk' => $item['jumlah_masuk'],
                    'satuan' => $item['satuan'],
                ]);

                // Update stok pada kelola_barang
                $kelolaBarang = KelolaBarang::where('nama_barang', $item['barang'])->first();
                if ($kelolaBarang) {
                    $kelolaBarang->stok += $item['jumlah_masuk'];
                    $kelolaBarang->save();
                }
            }

            DB::commit();
            return redirect()->route('adminbarang.barangmasuk.index')
                ->with('success', 'Data barang masuk berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $kelolabarangs = KelolaBarang::all();
        $satuans = Satuan::all();
        return view('barangmasuk.edit', compact('barangmasuk', 'kelolabarangs', 'satuans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_masuks,id_transaksi,' . $id,
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_masuk' => 'required|integer',
            'satuan' => 'required|string',
        ], [
            'id_transaksi.required' => 'ID Transaksi wajib diisi.',
            'id_transaksi.unique' => 'ID Transaksi sudah digunakan.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'barang.required' => 'Nama barang wajib diisi.',
            'jumlah_masuk.required' => 'Jumlah masuk wajib diisi.',
            'jumlah_masuk.integer' => 'Jumlah masuk harus berupa angka.',
            'satuan.required' => 'Satuan wajib diisi.',
        ]);

        try {
            DB::beginTransaction();

        $barangmasuk = BarangMasuk::findOrFail($id);
            
            // Kembalikan stok lama
            $kelolaBarangLama = KelolaBarang::where('nama_barang', $barangmasuk->barang)->first();
            if ($kelolaBarangLama) {
                $kelolaBarangLama->stok -= $barangmasuk->jumlah_masuk;
                $kelolaBarangLama->save();
            }

            // Update data barang masuk
        $barangmasuk->update($request->all());

            // Update stok baru
            $kelolaBarangBaru = KelolaBarang::where('nama_barang', $request->barang)->first();
            if ($kelolaBarangBaru) {
                $kelolaBarangBaru->stok += $request->jumlah_masuk;
                $kelolaBarangBaru->save();
            }

            DB::commit();
            return redirect()->route('adminbarang.barangmasuk.index')
                ->with('success', 'Data barang masuk berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $barangmasuk = BarangMasuk::findOrFail($id);
            
            // Kembalikan stok
            $kelolaBarang = KelolaBarang::where('nama_barang', $barangmasuk->barang)->first();
            if ($kelolaBarang) {
                $kelolaBarang->stok -= $barangmasuk->jumlah_masuk;
                $kelolaBarang->save();
            }

            $barangmasuk->delete();

            DB::commit();
            return redirect()->route('adminbarang.barangmasuk.index')
                ->with('success', 'Data barang masuk berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama Barang');
        $sheet->setCellValue('B1', 'Jumlah Masuk');
        $sheet->setCellValue('C1', 'Satuan');

        // Contoh data
        $sheet->setCellValue('A2', 'Pupuk NPK');
        $sheet->setCellValue('B2', '20');
        $sheet->setCellValue('C2', 'Kg');

        $sheet->setCellValue('A3', 'Pupuk Urea');
        $sheet->setCellValue('B3', '15');
        $sheet->setCellValue('C3', 'Kg');

        // Otomatis atur lebar kolom
        foreach(range('A','C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Buat writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_barang_masuk.xlsx"');
        header('Cache-Control: max-age=0');

        // Simpan ke output PHP
        $writer->save('php://output');
        exit;
    }

    public function importForm()
    {
        return view('barangmasuk.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'File harus berupa file Excel (.xlsx atau .xls).',
            'file.max' => 'Ukuran file maksimal 2MB.',
        ]);

        try {
            DB::beginTransaction();

            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            // Lewati baris header
            array_shift($rows);

            // Generate ID Transaksi otomatis
            $prefix = 'TRX-BM-' . date('Ymd');
            $lastTransaction = BarangMasuk::where('id_transaksi', 'like', $prefix . '%')
                ->orderBy('id_transaksi', 'desc')
                ->first();

            if ($lastTransaction) {
                $lastNumber = (int) substr($lastTransaction->id_transaksi, -4);
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }
            
            $idTransaksi = $prefix . $newNumber;

            $errors = [];
            $successCount = 0;

            foreach ($rows as $index => $row) {
                // Lewati baris kosong
                if (empty($row[0])) continue;

                $namaBarang = trim($row[0]);
                $jumlahMasuk = (int)$row[1];
                $satuan = trim($row[2]);

                // Validasi data
                $kelolaBarang = KelolaBarang::where('nama_barang', $namaBarang)->first();
                $satuanExists = Satuan::where('nama_satuan', $satuan)->first();

                if (!$kelolaBarang) {
                    $errors[] = "Baris " . ($index + 2) . ": Barang '$namaBarang' tidak ditemukan";
                    continue;
                }

                if (!$satuanExists) {
                    $errors[] = "Baris " . ($index + 2) . ": Satuan '$satuan' tidak valid";
                    continue;
                }

                if ($jumlahMasuk <= 0) {
                    $errors[] = "Baris " . ($index + 2) . ": Jumlah masuk harus lebih dari 0";
                    continue;
                }

                // Generate unique ID for each item
                $prefix = 'TRX-BM-' . date('Ymd');
                $lastTransaction = BarangMasuk::where('id_transaksi', 'like', $prefix . '%')
                    ->orderBy('id_transaksi', 'desc')
                    ->first();

                if ($lastTransaction) {
                    $lastNumber = (int) substr($lastTransaction->id_transaksi, -4);
                    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = '0001';
                }
                
                $idTransaksi = $prefix . $newNumber;

                // Buat data barang masuk
                BarangMasuk::create([
                    'id_transaksi' => $idTransaksi,
                    'tanggal' => date('Y-m-d'),
                    'barang' => $namaBarang,
                    'jumlah_masuk' => $jumlahMasuk,
                    'satuan' => $satuan,
                ]);

                // Update stok barang
                $kelolaBarang->stok += $jumlahMasuk;
                $kelolaBarang->save();

                $successCount++;
            }

            DB::commit();

            if (count($errors) > 0) {
                return redirect()->route('adminbarang.barangmasuk.import')
                    ->with('warning', "Berhasil mengimpor $successCount data. Terdapat " . count($errors) . " error:")
                    ->with('import_errors', $errors);
            }

            return redirect()->route('adminbarang.barangmasuk.index')
                ->with('success', "Berhasil mengimpor $successCount data barang masuk!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangmasuk'));
    }
}
