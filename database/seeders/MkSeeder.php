<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mk; // Import model
use Illuminate\Support\Facades\Schema; // 1. Tambahkan ini
use Illuminate\Database\Schema\Blueprint;




class MkSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // 2. Tambahkan ini
        Mk::truncate(); // Kosongkan tabel dulu
        Schema::enableForeignKeyConstraints();  // 3. Tambahkan ini
        
        Mk::create(['nama_mk' => 'Analisa Proses Bisnis']);
        Mk::create(['nama_mk' => 'Instalasi Komputer dan Jaringan']);
        Mk::create(['nama_mk' => 'Perpajakan']);
        Mk::create(['nama_mk' => 'Kewirausahaan']);
        Mk::create(['nama_mk' => 'KPAM III (Etika Perkantoran)']);
        Mk::create(['nama_mk' => 'Pemrograman Web']);
        Mk::create(['nama_mk' => 'Pemrograman Java']);
        Mk::create(['nama_mk' => 'PLSQL (Pemrog. Database)']);
        Mk::create(['nama_mk' => 'Pemograman Databases (PLSQL)']);
        Mk::create(['nama_mk' => 'Pendidikan Kewarganegaraan']);
        Mk::create(['nama_mk' => 'Riset Teknologi Informasi']);
        Mk::create(['nama_mk' => 'Pendidikan Agama Islam II']);
        Mk::create(['nama_mk' => 'Manajemen Bisnis (E-Business)']);
        Mk::create(['nama_mk' => 'Sistem Basis Data']);
    }
}