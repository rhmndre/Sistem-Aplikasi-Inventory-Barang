<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $fillable = ['nama_jenis'];

    public function kelolaBarangs()
    {
        return $this->hasMany(KelolaBarang::class, 'jenis_barang', 'nama_jenis');
    }
}
