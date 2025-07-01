<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaBarang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'stok',
        'satuan',
    ];
}
