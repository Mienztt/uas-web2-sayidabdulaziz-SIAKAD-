<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '242505022',
                'nama' => 'Sayid Abdul Aziz',
                'alamat' => 'Jl. Merdeka No.1',
                'id_prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '242505024',
                'nama' => 'Muhammad Yusuf Wildan Sofyan',
                'alamat' => 'Jl. Mawar 2',
                'id_prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '242505013',
                'nama' => 'Muhammad Sandi Satria Putra',
                'alamat' => 'Jl. Melati 10',
                'id_prodi' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '242505014',
                'nama' => 'Ridwan Taufik',
                'alamat' => 'Jl. Kenanga 5',
                'id_prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '230101005',
                'nama' => 'Riski Ramadhani',
                'alamat' => 'Jl. Cendana 7',
                'id_prodi' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
