<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Faktur extends Model
{
    protected $fillable = [
        'nomor_faktur',
        'tanggal_faktur',
        'id_transaksi',
        'nama_barang',
        'jenis_barang',
        'jumlah',
        'satuan',
        'harga_satuan',
        'total_harga',
        'keterangan'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($faktur) {
            // Generate nomor faktur jika belum diset
            if (empty($faktur->nomor_faktur)) {
                $faktur->nomor_faktur = static::generateNomorFaktur();
            }
        });
    }

    public static function generateNomorFaktur()
    {
        $today = Carbon::now();
        $prefix = 'INV'; // Prefix untuk Invoice
        $yearMonth = $today->format('Ym'); // Format: YYYYMM
        
        // Ambil nomor faktur terakhir dengan prefix dan tahun-bulan yang sama
        $lastFaktur = static::where('nomor_faktur', 'like', $prefix . $yearMonth . '%')
            ->orderBy('nomor_faktur', 'desc')
            ->first();

        if ($lastFaktur) {
            // Ambil 4 digit terakhir dan tambah 1
            $lastNumber = intval(substr($lastFaktur->nomor_faktur, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada faktur untuk bulan ini, mulai dari 0001
            $newNumber = '0001';
        }

        // Format: INV + YYYYMM + 4 digit nomor urut
        return $prefix . $yearMonth . $newNumber;
    }

    // Relationships
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_transaksi', 'id_transaksi');
    }

    public function kelolaBarang()
    {
        return $this->belongsTo(KelolaBarang::class, 'nama_barang', 'nama_barang');
    }
} 