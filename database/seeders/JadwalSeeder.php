<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal; // Import model utama

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel jadwal
        Jadwal::truncate();

        // Data ID ini harus SAMA PERSIS dengan urutan
        // data yang kita masukkan di Seeder lainnya.

        // == HARI SENIN ==
        Jadwal::create(['mk_id' => 1, 'dosen_id' => 1, 'ruang_id' => 1, 'shift_id' => 1]);
        Jadwal::create(['mk_id' => 2, 'dosen_id' => 2, 'ruang_id' => 1, 'shift_id' => 2]);
        Jadwal::create(['mk_id' => 3, 'dosen_id' => 3, 'ruang_id' => 2, 'shift_id' => 3]);
        Jadwal::create(['mk_id' => 4, 'dosen_id' => 4, 'ruang_id' => 4, 'shift_id' => 4]);
        Jadwal::create(['mk_id' => 5, 'dosen_id' => 5, 'ruang_id' => 3, 'shift_id' => 5]);
        Jadwal::create(['mk_id' => 6, 'dosen_id' => 6, 'ruang_id' => 5, 'shift_id' => 6]);

        // == HARI SELASA ==
        Jadwal::create(['mk_id' => 7, 'dosen_id' => 7, 'ruang_id' => 6, 'shift_id' => 7]);
        Jadwal::create(['mk_id' => 8, 'dosen_id' => 8, 'ruang_id' => 6, 'shift_id' => 8]);
        Jadwal::create(['mk_id' => 9, 'dosen_id' => 8, 'ruang_id' => 5, 'shift_id' => 9]);
        Jadwal::create(['mk_id' => 10, 'dosen_id' => 9, 'ruang_id' => 7, 'shift_id' => 10]);
        Jadwal::create(['mk_id' => 11, 'dosen_id' => 10, 'ruang_id' => 8, 'shift_id' => 11]);

        // == HARI RABU ==
        Jadwal::create(['mk_id' => 12, 'dosen_id' => 11, 'ruang_id' => 3, 'shift_id' => 12]);
        Jadwal::create(['mk_id' => 13, 'dosen_id' => 2, 'ruang_id' => 4, 'shift_id' => 13]);
        Jadwal::create(['mk_id' => 14, 'dosen_id' => 8, 'ruang_id' => 6, 'shift_id' => 14]);
        Jadwal::create(['mk_id' => 14, 'dosen_id' => 8, 'ruang_id' => 9, 'shift_id' => 15]);
    }
}