<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
$this->call([
           DosenSeeder::class,
            RuangSeeder::class,
            MkSeeder::class,
            ShiftSeeder::class,
            RolePermissionSeeder::class, 
            JadwalSeeder::class,
        ]);
        
        $this->call(JadwalSeeder::class);


    }
}
