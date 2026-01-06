<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buku = [
            [
                'judul' => 'Pemrograman Web dengan Laravel',
                'pengarang' => 'Sayid Abdul Azis',
                'tahun_terbit' => '2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Belajar PHP untuk Pemula',
                'pengarang' => 'Jane Smith',
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Database MySQL dari Nol',
                'pengarang' => 'Alice Johnson',
                'tahun_terbit' => 2020,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('buku')->insert($buku);
        
    }
}
