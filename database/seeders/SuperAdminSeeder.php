<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [ 'email' => 'superadmin@pioneraura.com' ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
            ]
        );
        User::updateOrCreate(
            [ 'email' => 'adminbarang@example.com' ],
            [
                'name' => 'Admin Barang',
                'password' => Hash::make('password'),
                'role' => 'adminbarang',
            ]
        );
        User::updateOrCreate(
            [ 'email' => 'kepalagudang@example.com' ],
            [
                'name' => 'Kepala Gudang',
                'password' => Hash::make('password'),
                'role' => 'kepalagudang',
            ]
        );
    }
}
