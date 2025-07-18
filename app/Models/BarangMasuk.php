<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'tanggal',
        'barang',
        'nama_barang',
        'jumlah_masuk',
        'satuan',
    ];

    public function kelolaBarang()
    {
        return $this->belongsTo(KelolaBarang::class, 'barang', 'nama_barang');
    }
}
