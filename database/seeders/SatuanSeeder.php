<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuans = [
            ['nama_satuan' => 'Kg'],
            ['nama_satuan' => 'Gram'],
            ['nama_satuan' => 'Liter'],
            ['nama_satuan' => 'Unit'],
            ['nama_satuan' => 'Pcs'],
            ['nama_satuan' => 'Box'],
            ['nama_satuan' => 'Vial'],
        ];

        foreach ($satuans as $satuan) {
            Satuan::updateOrCreate(
                ['nama_satuan' => $satuan['nama_satuan']],
                $satuan
            );
        }
    }
} 