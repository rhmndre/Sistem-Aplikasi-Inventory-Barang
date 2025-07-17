<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelolaBarang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'satuan',
        'stok',
        'harga',
        'keterangan',
        'foto'
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan', 'nama_satuan');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang', 'nama_jenis');
    }

    public function satuanBarang()
    {
        return $this->belongsTo(Satuan::class, 'satuan', 'nama_satuan');
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'barang', 'nama_barang');
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'barang', 'nama_barang');
    }

    public function fakturs()
    {
        return $this->hasMany(Faktur::class, 'nama_barang', 'nama_barang');
    }
}
