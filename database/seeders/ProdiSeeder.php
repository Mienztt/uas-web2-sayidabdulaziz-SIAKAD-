<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        // Masukkan nama, kode, dan jenjang
        Prodi::updateOrCreate(
            ['id' => 1], 
            ['nama_prodi' => 'Sistem Informasi', 'kode_prodi' => 'SI', 'jenjang' => 'S1']
        );
        
        Prodi::updateOrCreate(
            ['id' => 2], 
            ['nama_prodi' => 'Bisnis Digital', 'kode_prodi' => 'BD', 'jenjang' => 'S1']
        );
        
        Prodi::updateOrCreate(
            ['id' => 3], 
            ['nama_prodi' => 'Manajemen Informatika', 'kode_prodi' => 'MI', 'jenjang' => 'D3']
        );
        
        Prodi::updateOrCreate(
            ['id' => 4], 
            ['nama_prodi' => 'Komputerisasi Akuntansi', 'kode_prodi' => 'KA', 'jenjang' => 'D3']
        );
    }
}