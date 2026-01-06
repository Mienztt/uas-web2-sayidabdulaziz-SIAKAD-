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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // == BUAT PERMISSIONS (IZIN AKSI) ==
        // Izin dasar
        Permission::create(['name' => 'view jadwal_ui']); // Izin lihat UI Google Sheet

        // Izin Admin/Kaprodi/Dekan
        Permission::create(['name' => 'manage data_master']); // CRUD Dosen, MK, Ruang, Kelas, Shift
        Permission::create(['name' => 'manage jadwal_crud']); // CRUD di /admin/jadwal
        
        // Izin Dekan
        Permission::create(['name' => 'create surat_tugas']); // Hanya Dekan 

        // Izin Dosen
        Permission::create(['name' => 'do charter']); // 
        Permission::create(['name' => 'do barter']); // 
        Permission::create(['name' => 'request pindah']); 

        // Izin Kosma
        Permission::create(['name' => 'approve pindah_jadwal']); // 


        // == BUAT ROLES (PERAN) ==
        // 
        $roleDekan = Role::create(['name' => 'Dekan']);
        $roleKaprodi = Role::create(['name' => 'Kaprodi']);
        $roleSekprodi = Role::create(['name' => 'Sekprodi']);
        $roleDosen = Role::create(['name' => 'Dosen']);
        $roleKosma = Role::create(['name' => 'Kosma']);
        $roleMahasiswa = Role::create(['name' => 'Mahasiswa']);

        
        // == BERIKAN PERMISSIONS KE ROLES ==

        // Dekan: Bisa semua + buat Surat Tugas 
        $roleDekan->givePermissionTo([
            'view jadwal_ui',
            'manage data_master',
            'manage jadwal_crud',
            'create surat_tugas' // Izin spesial Dekan
        ]);

        // Kaprodi: Bisa semua data master, tapi tidak bisa buat Surat Tugas 
        $roleKaprodi->givePermissionTo([
            'view jadwal_ui',
            'manage data_master',
            'manage jadwal_crud'
        ]);

        // Sekprodi: (Asumsi sama dengan Kaprodi untuk saat ini)
        $roleSekprodi->givePermissionTo([
            'view jadwal_ui',
            'manage data_master',
            'manage jadwal_crud'
        ]);

        // Dosen: Bisa lihat jadwal & aksi khusus 
        $roleDosen->givePermissionTo([
            'view jadwal_ui',
            'do charter',
            'do barter',
            'request pindah'
        ]);

        // Kosma: Bisa lihat jadwal & approve/reject 
        $roleKosma->givePermissionTo([
            'view jadwal_ui',
            'approve pindah_jadwal'
        ]);
        
        // Mahasiswa: Hanya bisa lihat jadwal
        $roleMahasiswa->givePermissionTo('view jadwal_ui');

        
        // == ASSIGN ROLE KE USER PERTAMA ==
        // Kita anggap user pertama (ID 1) adalah Dekan
        $userAdmin = User::first(); 
        if ($userAdmin) {
            $userAdmin->assignRole('Dekan');
        }
    }
}