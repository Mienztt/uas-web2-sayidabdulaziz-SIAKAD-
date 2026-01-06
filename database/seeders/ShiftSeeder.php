<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift; // Import model
use Illuminate\Support\Facades\Schema; // 1. Tambahkan ini
use Illuminate\Database\Schema\Blueprint;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints(); // 2. Tambahkan ini
        Shift::truncate(); // Kosongkan tabel dulu
        Schema::enableForeignKeyConstraints();  // 3. Tambahkan ini
       
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'S1 SI']);
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '10:10', 'jam_selesai' => '11:50', 'prodi' => 'S1 SI']);
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '08:30', 'jam_selesai' => '10:10', 'prodi' => 'D3 KA']);
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '10:10', 'jam_selesai' => '11:50', 'prodi' => 'D3 KA']);
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '09:10', 'jam_selesai' => '10:00', 'prodi' => 'S1 BD / A']);
        Shift::create(['hari' => 'Senin', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'S1 BD / B']);
        
        Shift::create(['hari' => 'Selasa', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'S1 SI']);
        Shift::create(['hari' => 'Selasa', 'jam_mulai' => '12:30', 'jam_selesai' => '13:20', 'prodi' => 'S1 SI']);
        Shift::create(['hari' => 'Selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '15:30', 'prodi' => 'D3 KA']);
        Shift::create(['hari' => 'Selasa', 'jam_mulai' => '08:20', 'jam_selesai' => '10:00', 'prodi' => 'S1 BD / A']);
        Shift::create(['hari' => 'Selasa', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'S1 BD / B']);
        
        Shift::create(['hari' => 'Rabu', 'jam_mulai' => '07:30', 'jam_selesai' => '09:10', 'prodi' => 'S1 SI']);
        Shift::create(['hari' => 'Rabu', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'D3 KA']);
        Shift::create(['hari' => 'Rabu', 'jam_mulai' => '10:10', 'jam_selesai' => '11:50', 'prodi' => 'S1 BD / A']);
        Shift::create(['hari' => 'Rabu', 'jam_mulai' => '07:30', 'jam_selesai' => '10:00', 'prodi' => 'S1 BD / B']);
    }
}