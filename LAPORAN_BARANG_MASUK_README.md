# Laporan Barang Masuk - Dokumentasi

## Gambaran Umum

Sistem laporan barang masuk telah dibuat dengan fitur lengkap yang mendukung 3 role berbeda:
- **Super Admin**: Akses penuh dengan kemampuan approve/reject dan kontrol administratif
- **Admin Barang**: Akses laporan dengan fitur manajemen barang
- **Kepala Gudang**: Fokus pada operasional gudang dan monitoring inventori

## File yang Dibuat/Diperbarui

### 1. Migration
- `database/migrations/2025_01_20_000001_enhance_barang_masuks_table_for_reports.php`
  - Menambah kolom: supplier, keterangan, harga_satuan, total_harga, status, approved_by, approved_at, created_by

### 2. Model
- `app/Models/BarangMasuk.php` (Updated)
  - Menambah relasi dengan User
  - Scope untuk filtering berdasarkan tanggal, status, bulan, tahun
  - Helper methods untuk statistik dan label status

### 3. Controller
- `app/Http/Controllers/LaporanController.php` (Enhanced)
  - Method `barangMasuk()` dengan role-based filtering
  - Method `exportBarangMasuk()` untuk export Excel/PDF
  - Method `getChartData()` untuk data grafik
  - Helper methods untuk statistik dan view selection

### 4. Views - Role Specific

#### Super Admin (`resources/views/laporan/barangmasuk/superadmin.blade.php`)
- Dashboard statistik lengkap (4 cards)
- Filter lengkap (tanggal, status, supplier, barang)
- Tabel data dengan kolom lengkap
- Fungsi approve/reject langsung dari view
- Export modal (Excel/PDF)
- Print functionality

#### Admin Barang (`resources/views/laporan/barangmasuk/adminbarang.blade.php`)
- Dashboard statistik (3 cards)
- Quick actions (laporan harian, mingguan, bulanan)
- Filter data (tanggal, supplier)
- Tabel data dengan informasi detail barang
- Ringkasan status approval
- Export functionality

#### Kepala Gudang (`resources/views/laporan/barangmasuk/kepalagudang.blade.php`)
- Dashboard gudang (2 cards utama)
- Quick actions untuk analisis operasional
- Fokus pada penerimaan barang dan nilai inventori
- Tampilan warehouse-centric
- Summary footer dengan metrics gudang

#### Default (`resources/views/laporan/barangmasuk/default.blade.php`)
- View fallback untuk role lain
- Fitur minimal dengan tabel basic

### 5. Routes
- `routes/web.php` (Updated)
  - Route untuk laporan dengan akses multi-role
  - Route export laporan
  - Route API untuk chart data

## Cara Setup

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Pastikan Role User sudah di-set
User harus memiliki salah satu role: `superadmin`, `adminbarang`, atau `kepalagudang`

### 3. Akses Route
- URL: `/laporan/barangmasuk`
- View akan otomatis disesuaikan berdasarkan role user

## Fitur Berdasarkan Role

### Super Admin
✅ Melihat semua data barang masuk  
✅ Filter lengkap (tanggal, status, supplier, barang)  
✅ Approve/Reject transaksi  
✅ Export Excel/PDF  
✅ View detail lengkap  
✅ Print laporan  
✅ Statistik comprehensive  

### Admin Barang
✅ Melihat data approved + data yang dia buat  
✅ Filter tanggal dan supplier  
✅ Quick actions (harian, mingguan, bulanan)  
✅ Export Excel/PDF  
✅ Print individual items  
✅ Ringkasan status approval  

### Kepala Gudang
✅ Melihat data yang sudah approved  
✅ Dashboard operasional gudang  
✅ Filter tanggal  
✅ Analisis trend inventori  
✅ Print surat terima gudang  
✅ Metrics warehouse-focused  

## Filtering & Export

### Filter yang Tersedia
- **Tanggal Mulai/Akhir**: Filter berdasarkan periode
- **Status**: pending, approved, rejected (Super Admin)
- **Supplier**: Pencarian berdasarkan nama supplier
- **Barang**: Pencarian berdasarkan nama barang (Super Admin)

### Export Options
- **Excel**: Format spreadsheet untuk analisis data
- **PDF**: Format laporan untuk dokumentasi
- Parameter filter otomatis diterapkan pada export

## Database Schema (Tambahan)

```sql
-- Kolom baru di tabel barang_masuks
ALTER TABLE barang_masuks ADD COLUMN (
  supplier VARCHAR(255) NULL,
  keterangan TEXT NULL,
  harga_satuan DECIMAL(10,2) NULL,
  total_harga DECIMAL(12,2) NULL,
  status ENUM('pending','approved','rejected') DEFAULT 'pending',
  approved_by VARCHAR(255) NULL,
  approved_at TIMESTAMP NULL,
  created_by VARCHAR(255) NULL
);
```

## API Endpoints

### Chart Data
- **GET** `/laporan/barangmasuk/chart-data`
- Parameter: `period` (monthly, weekly, yearly)
- Response: JSON data untuk grafik

### Export
- **GET** `/laporan/barangmasuk/export`
- Parameter: `format` (excel, pdf) + filter parameters
- Response: File download

## Security & Authorization

- Route dilindungi middleware `auth`
- Role-based access control untuk semua 3 role
- Data filtering berdasarkan role untuk security
- Export hanya data yang user berhak akses

## Customization

### Menambah Role Baru
1. Update middleware di routes
2. Tambah case di method `getViewNameByRole()`
3. Buat view baru di `resources/views/laporan/barangmasuk/[role].blade.php`

### Menambah Export Format
1. Tambah method baru di LaporanController
2. Install package yang dibutuhkan (Maatwebsite/Excel, DomPDF)
3. Update export modal di views

## Package Dependencies (Opsional)

Untuk fitur export yang fully functional:

```bash
# Excel Export
composer require maatwebsite/excel

# PDF Export  
composer require barryvdh/laravel-dompdf
# atau
composer require knplabs/knp-snappy-bundle
```

## Testing

### Test Manual
1. Login dengan user role `superadmin`
2. Akses `/laporan/barangmasuk`
3. Test filtering dan export
4. Ulangi untuk role lain

### Sample Data
Pastikan ada data di tabel `barang_masuks` untuk testing view.

## Troubleshooting

### View tidak muncul sesuai role
- Periksa role user di database
- Pastikan middleware route sudah benar

### Export tidak berfungsi
- Install package Excel/PDF yang dibutuhkan
- Implementasikan method export dengan package tersebut

### Error 500 pada laporan
- Periksa relasi User model
- Pastikan migration sudah dijalankan

## Next Steps

1. Implementasi export Excel/PDF dengan package
2. Tambah fitur grafik/chart real-time
3. Notifikasi untuk approval workflow
4. Audit trail untuk tracking perubahan
5. Bulk approval/rejection untuk Super Admin