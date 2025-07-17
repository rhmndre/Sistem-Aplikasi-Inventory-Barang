<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_transaksi",
        "tanggal",
        "barang",
        "jumlah_keluar",
        "jumlah_barang",
        "satuan",
    ];

    public function kelolaBarang()
    {
        return $this->belongsTo(KelolaBarang::class, "barang", "nama_barang");
    }
}
