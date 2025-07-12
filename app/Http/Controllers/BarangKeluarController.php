<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\KelolaBarang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangkeluars = BarangKeluar::all();
        return view('barangkeluar.index', compact('barangkeluars'));
    }

    public function create()
    {
        $kelolabarangs = KelolaBarang::all();
        $satuans = Satuan::all();
        return view('barangkeluar.create', compact('kelolabarangs', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_keluars,id_transaksi',
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_keluar' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        BarangKeluar::create($request->all());
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.edit', compact('barangkeluar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_transaksi' => 'required|string|unique:barang_keluars,id_transaksi,' . $id,
            'tanggal' => 'required|date',
            'barang' => 'required|string',
            'jumlah_keluar' => 'required|integer',
            'satuan' => 'required|string',
        ]);
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->update($request->all());
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil dihapus!');
    }

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama Barang');
        $sheet->setCellValue('B1', 'Jumlah Keluar');
        $sheet->setCellValue('C1', 'Satuan');

        // Contoh data
        $sheet->setCellValue('A2', 'Pupuk NPK');
        $sheet->setCellValue('B2', '10');
        $sheet->setCellValue('C2', 'Kg');

        $sheet->setCellValue('A3', 'Pupuk Urea');
        $sheet->setCellValue('B3', '5');
        $sheet->setCellValue('C3', 'Kg');

        // Otomatis atur lebar kolom
        foreach(range('A','C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Buat writer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_barang_keluar.xlsx"');
        header('Cache-Control: max-age=0');

        // Simpan ke output PHP
        $writer->save('php://output');
        exit;
    }

    public function importForm()
    {
        return view('barangkeluar.import');
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
            $prefix = 'TRX-BK-' . date('Ymd');
            $lastTransaction = BarangKeluar::where('id_transaksi', 'like', $prefix . '%')
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
                $jumlahKeluar = (int)$row[1];
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

                if ($jumlahKeluar <= 0) {
                    $errors[] = "Baris " . ($index + 2) . ": Jumlah keluar harus lebih dari 0";
                    continue;
                }

                // Cek stok
                if ($kelolaBarang->stok < $jumlahKeluar) {
                    $errors[] = "Baris " . ($index + 2) . ": Stok '$namaBarang' tidak mencukupi. Stok tersedia: {$kelolaBarang->stok}";
                    continue;
                }

                // Buat data barang keluar
                BarangKeluar::create([
                    'id_transaksi' => $idTransaksi,
                    'tanggal' => date('Y-m-d'),
                    'barang' => $namaBarang,
                    'jumlah_keluar' => $jumlahKeluar,
                    'satuan' => $satuan,
                ]);

                // Update stok barang
                $kelolaBarang->stok -= $jumlahKeluar;
                $kelolaBarang->save();

                $successCount++;
            }

            DB::commit();

            if (count($errors) > 0) {
                return redirect()->route('adminbarang.barangkeluar.import')
                    ->with('warning', "Berhasil mengimpor $successCount data. Terdapat " . count($errors) . " error:")
                    ->with('import_errors', $errors);
            }

            return redirect()->route('adminbarang.barangkeluar.index')
                ->with('success', "Berhasil mengimpor $successCount data barang keluar!");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
