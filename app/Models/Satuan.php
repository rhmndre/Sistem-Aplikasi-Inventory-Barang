<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $fillable = ['nama_satuan'];

    public function kelolaBarangs()
    {
        return $this->hasMany(KelolaBarang::class, 'satuan', 'nama_satuan');
    }
}
