<?php

namespace Database\Seeders;

use App\Models\KelolaBarang;
use Illuminate\Database\Seeder;

class KelolaBarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            // Pupuk
            [
                'kode_barang' => 'PPK001',
                'nama_barang' => 'Pupuk NPK',
                'jenis_barang' => 'Pupuk',
                'stok' => 100,
                'satuan' => 'Kg',
                'harga' => 15000,
                'keterangan' => 'Pupuk NPK 16-16-16'
            ],
            [
                'kode_barang' => 'PPK002',
                'nama_barang' => 'Pupuk Urea',
                'jenis_barang' => 'Pupuk',
                'stok' => 150,
                'satuan' => 'Kg',
                'harga' => 12000,
                'keterangan' => 'Pupuk Urea Subsidi'
            ],
            [
                'kode_barang' => 'PPK003',
                'nama_barang' => 'Pupuk Organik',
                'jenis_barang' => 'Pupuk',
                'stok' => 80,
                'satuan' => 'Kg',
                'harga' => 8000,
                'keterangan' => 'Pupuk kompos organik'
            ],
            
            // Bibit
            [
                'kode_barang' => 'BBT001',
                'nama_barang' => 'Bibit Padi',
                'jenis_barang' => 'Bibit',
                'stok' => 200,
                'satuan' => 'Kg',
                'harga' => 25000,
                'keterangan' => 'Bibit padi unggul'
            ],
            [
                'kode_barang' => 'BBT002',
                'nama_barang' => 'Bibit Jagung',
                'jenis_barang' => 'Bibit',
                'stok' => 150,
                'satuan' => 'Kg',
                'harga' => 35000,
                'keterangan' => 'Bibit jagung hibrida'
            ],
            [
                'kode_barang' => 'BBT003',
                'nama_barang' => 'Bibit Cabai',
                'jenis_barang' => 'Bibit',
                'stok' => 1000,
                'satuan' => 'Gram',
                'harga' => 5000,
                'keterangan' => 'Bibit cabai rawit'
            ],

            // Produk Stunting
            [
                'kode_barang' => 'STN001',
                'nama_barang' => 'Susu Formula Stunting',
                'jenis_barang' => 'Produk Stunting',
                'stok' => 50,
                'satuan' => 'Box',
                'harga' => 185000,
                'keterangan' => 'Susu khusus pencegahan stunting'
            ],
            [
                'kode_barang' => 'STN002',
                'nama_barang' => 'Biskuit PMT Balita',
                'jenis_barang' => 'Produk Stunting',
                'stok' => 100,
                'satuan' => 'Box',
                'harga' => 45000,
                'keterangan' => 'Biskuit PMT untuk balita'
            ],
            [
                'kode_barang' => 'STN003',
                'nama_barang' => 'Vitamin Ibu Hamil',
                'jenis_barang' => 'Produk Stunting',
                'stok' => 200,
                'satuan' => 'Box',
                'harga' => 75000,
                'keterangan' => 'Suplemen untuk ibu hamil'
            ],

            // Vaksin Ternak
            [
                'kode_barang' => 'VKS001',
                'nama_barang' => 'Vaksin ND',
                'jenis_barang' => 'Vaksin Ternak',
                'stok' => 100,
                'satuan' => 'Vial',
                'harga' => 150000,
                'keterangan' => 'Vaksin Newcastle Disease untuk unggas'
            ],
            [
                'kode_barang' => 'VKS002',
                'nama_barang' => 'Vaksin SE',
                'jenis_barang' => 'Vaksin Ternak',
                'stok' => 80,
                'satuan' => 'Vial',
                'harga' => 175000,
                'keterangan' => 'Vaksin Salmonella Enteritidis'
            ],
            [
                'kode_barang' => 'VKS003',
                'nama_barang' => 'Obat Cacing Ternak',
                'jenis_barang' => 'Vaksin Ternak',
                'stok' => 150,
                'satuan' => 'Box',
                'harga' => 85000,
                'keterangan' => 'Obat cacing untuk sapi dan kambing'
            ],
        ];

        foreach ($barang as $item) {
            KelolaBarang::create($item);
        }
    }
} 