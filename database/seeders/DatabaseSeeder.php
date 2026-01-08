<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan semua seeder master data & role dulu
        $this->call([
            ProdiSeeder::class, // Harus paling ata
            DosenSeeder::class,
            RolePermissionSeeder::class, // Taruh paling atas agar role tersedia
            DosenSeeder::class,
            RuangSeeder::class,
            MkSeeder::class,
            ShiftSeeder::class,
            JadwalSeeder::class,
        ]);
        
        // 2. Buat akun Dekan secara manual jika belum ada
        if (!User::where('email', 'dekan@gmail.com')->exists()) {
            $dekan = User::create([
                'name' => 'Haekal Pirous, S.T., M.A.B.',
                'email' => 'dekan@gmail.com',
                'password' => Hash::make('dekan123'),
            ]);

            // Assign role 'Dekan'
            // Syarat: Role 'Dekan' sudah dibuat di RolePermissionSeeder
            $dekan->assignRole('Dekan');
        }

        // 3. Opsi: Tambah akun Kaprodi/Admin lain di sini jika mau
    }
}