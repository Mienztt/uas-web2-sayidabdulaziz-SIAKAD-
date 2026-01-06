<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruang; // Import model
use Illuminate\Support\Facades\Schema; // <-- PASTIKAN BARIS INI ADA
use Illuminate\Database\Schema\Blueprint;



class RuangSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // 2. Tambahkan ini
        Ruang::truncate(); // Kosongkan tabel dulu
        Schema::enableForeignKeyConstraints();  // 3. Tambahkan ini

        Ruang::create(['nama_ruang' => 'Lab. Jaringan']);
        Ruang::create(['nama_ruang' => 'A203']);
        Ruang::create(['nama_ruang' => 'A209']);
        Ruang::create(['nama_ruang' => 'A210']);
        Ruang::create(['nama_ruang' => 'B303']);
        Ruang::create(['nama_ruang' => 'B301']);
        Ruang::create(['nama_ruang' => 'A204']);
        Ruang::create(['nama_ruang' => 'A211']);
        Ruang::create(['nama_ruang' => 'B302']);
    }
}