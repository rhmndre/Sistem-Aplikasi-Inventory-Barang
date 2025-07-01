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
        'jumlah_barang',
        'jumlah_masuk',
        'satuan',
    ];
}
