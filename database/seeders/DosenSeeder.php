<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use Illuminate\Support\Facades\Schema; // <-- PASTIKAN BARIS INI ADA

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3 BARIS INI ADALAH KUNCI PERBAIKANNYA
        Schema::disableForeignKeyConstraints(); // <-- 1. Matikan cek relasi
        Dosen::truncate();                      // <-- 2. Kosongkan tabel
        Schema::enableForeignKeyConstraints();  // <-- 3. Nyalakan lagi cek relasi

        // Baris di bawah ini adalah data Anda
        Dosen::create(['nama_dosen' => 'Dr. Jajang Suherman, M.A.B']);
        Dosen::create(['nama_dosen' => 'Aji M\'uazul Mu\'minin, S.Kom., M.M']);
        Dosen::create(['nama_dosen' => 'Badriyatul Huda, SE, MM']);
        Dosen::create(['nama_dosen' => 'Ida Rapida, Dra., M.M']);
        Dosen::create(['nama_dosen' => 'Ir. Raden Haerudjaman']);
        Dosen::create(['nama_dosen' => 'M. Fahmi Nugraha, M.Kom']);
        Dosen::create(['nama_dosen' => 'M. Prslarisz, S.T., M.Kom']);
        Dosen::create(['nama_dosen' => 'Utami Aryani, M.Kom']);
        Dosen::create(['nama_dosen' => 'Yelly A.M.S., Dra., M.Pd.']);
        Dosen::create(['nama_dosen' => 'Safia Dewi, S.T., M.Kom']);
        Dosen::create(['nama_dosen' => 'Mimin Mintarsih, M.Ag']);
    }
}