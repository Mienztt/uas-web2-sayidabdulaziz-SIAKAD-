<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions (Penting!)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // == 1. BUAT PERMISSIONS (Gunakan firstOrCreate agar tidak duplikat) ==
        $p1 = Permission::firstOrCreate(['name' => 'view jadwal_ui']);
        $p2 = Permission::firstOrCreate(['name' => 'manage data_master']);
        $p3 = Permission::firstOrCreate(['name' => 'manage jadwal_crud']);
        $p4 = Permission::firstOrCreate(['name' => 'create surat_tugas']);
        $p5 = Permission::firstOrCreate(['name' => 'do charter']);
        $p6 = Permission::firstOrCreate(['name' => 'do barter']);
        $p7 = Permission::firstOrCreate(['name' => 'request pindah']);
        $p8 = Permission::firstOrCreate(['name' => 'approve pindah_jadwal']);


        // == 2. BUAT ROLES (Gunakan firstOrCreate) ==
        $roleDekan     = Role::firstOrCreate(['name' => 'Dekan']);
        $roleKaprodi   = Role::firstOrCreate(['name' => 'Kaprodi']);
        $roleSekprodi  = Role::firstOrCreate(['name' => 'Sekprodi']);
        $roleDosen     = Role::firstOrCreate(['name' => 'Dosen']);
        $roleKosma     = Role::firstOrCreate(['name' => 'Kosma']);
        $roleMahasiswa = Role::firstOrCreate(['name' => 'Mahasiswa']);

        
        // == 3. SYNC PERMISSIONS KE ROLES ==
        // Gunakan syncPermissions agar tidak menumpuk izin yang sama berkali-kali

        // Dekan
        $roleDekan->syncPermissions(['view jadwal_ui', 'manage data_master', 'manage jadwal_crud', 'create surat_tugas']);

        // Kaprodi & Sekprodi
        $roleKaprodi->syncPermissions(['view jadwal_ui', 'manage data_master', 'manage jadwal_crud']);
        $roleSekprodi->syncPermissions(['view jadwal_ui', 'manage data_master', 'manage jadwal_crud']);

        // Dosen
        $roleDosen->syncPermissions(['view jadwal_ui', 'do charter', 'do barter', 'request pindah']);

        // Kosma
        $roleKosma->syncPermissions(['view jadwal_ui', 'approve pindah_jadwal']);
        
        // Mahasiswa
        $roleMahasiswa->syncPermissions(['view jadwal_ui']);

        
        // == 4. ASSIGN ROLE KE USER (Opsional di sini) ==
        // Catatan: Jika kamu sudah membuat Dekan di DatabaseSeeder, 
        // bagian ini boleh dikosongkan agar tidak bentrok.
        $userAdmin = User::first(); 
        if ($userAdmin) {
            $userAdmin->assignRole('Dekan');
        }
    }
}