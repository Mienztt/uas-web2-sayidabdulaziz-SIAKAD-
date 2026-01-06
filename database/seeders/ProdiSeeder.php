<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insert([
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'MI',
                'nama_prodi' => 'Manajemen Informatika',
                'jenjang' => 'D3',
            ],
        ]);
    }
}
