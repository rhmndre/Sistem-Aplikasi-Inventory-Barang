<?php

namespace Database\Seeders;

use App\Models\JenisBarang;
use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    public function run(): void
    {
        $jenisBarang = [
            [
                'nama_jenis' => 'Pupuk',
                'keterangan' => 'Berbagai jenis pupuk untuk pertanian'
            ],
            [
                'nama_jenis' => 'Bibit',
                'keterangan' => 'Bibit tanaman dan benih pertanian'
            ],
            [
                'nama_jenis' => 'Produk Stunting',
                'keterangan' => 'Produk untuk pencegahan dan penanganan stunting'
            ],
            [
                'nama_jenis' => 'Vaksin Ternak',
                'keterangan' => 'Vaksin dan obat-obatan untuk hewan ternak'
            ]
        ];

        foreach ($jenisBarang as $jenis) {
            JenisBarang::create($jenis);
        }
    }
} 