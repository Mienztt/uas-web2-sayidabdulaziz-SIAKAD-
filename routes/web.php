<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MhsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Models\Mhs;
// Import Admin Controllers
use App\Http\Controllers\Admin\JadwalCrudController;
use App\Http\Controllers\Admin\DosenCrudController;
use App\Http\Controllers\Admin\MkCrudController;
use App\Http\Controllers\Admin\RuangCrudController;
use App\Http\Controllers\Admin\ShiftCrudController;
use App\Http\Controllers\Admin\KelasCrudController;
use App\Http\Controllers\Admin\SuratTugasCrudController;
use App\Http\Controllers\Dosen\CharterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. RUTE PUBLIK (Non-Sensitif)
// Bisa diakses siapa saja, kapan saja.
Route::get('/', function () {
    $data = Mhs::all();
    return view('welcome', compact('data'));

});
Route::get('/cari-mhs', [MhsController::class, 'cari'])->name('mhs.cari');


// 2. RUTE UNTUK SEMUA USER YANG SUDAH LOGIN
// Semua rute di dalam grup ini WAJIB login dan email terverifikasi.
// Jika belum login, akan otomatis diarahkan ke halaman login.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class);   
    // Dashboard (Bisa diakses semua role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Bisa diakses semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Jadwal UI (Google Sheet)
    // Hanya bisa diakses oleh role yang disebutkan
    Route::get('/jadwal', [JadwalController::class, 'index'])
         ->middleware(['role:Dekan|Kaprodi|Sekprodi|Dosen|Mahasiswa']) 
         ->name('jadwal');

    // Grup Aksi Dosen (Hanya Dosen)
    Route::middleware(['role:Dosen'])
         ->prefix('dosen-actions')
         ->name('dosen.')
         ->group(function() {
            Route::post('/barter', function() { return 'Proses Barter'; })->name('barter');
            Route::post('/charter', function() { return 'Proses Charter'; })->name('charter');
            Route::post('/pindah', function() { return 'Proses Pindah'; })->name('pindah');
         });

    // 3. GRUP ADMIN (HANYA UNTUK ROLE TERTENTU)
    // Grup ini ada DI DALAM 'auth', 'verified'
    Route::middleware(['role:Dekan|Kaprodi|Sekprodi', 'auth-group'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
        
        // Rute admin non-sensitif & sensitif (dari Level 7)
        Route::get('/contact', function () {
            return 'Ini halaman Kontak Admin (Non-Sensitif). Anda berhasil masuk!';
        })->name('contact');

        Route::get('/finansial', function () {
            return 'ANDA TIDAK SEHARUSNYA MELIHAT INI!';
        })->middleware('auth-group-sensitif')->name('finansial');

        // Semua Rute CRUD Master Data
        Route::resource('jadwal', JadwalCrudController::class);
        Route::resource('dosens', DosenCrudController::class);
        Route::resource('mks', MkCrudController::class);
        Route::resource('ruangs', RuangCrudController::class);
        Route::resource('shifts', ShiftCrudController::class);
        Route::resource('kelas', KelasCrudController::class);

        // Rute Khusus Dekan (Surat Tugas)
        Route::resource('surat-tugas', SuratTugasCrudController::class)->middleware('role:Dekan');
        Route::get('/surat-tugas/{suratTuga}/cetak', [SuratTugasCrudController::class, 'cetakPdf'])
             ->name('surat-tugas.cetak')
             ->middleware('role:Dekan');

             
    });
    Route::middleware(['role:Dosen'])
     ->prefix('dosen-actions')
     ->name('dosen.')
     ->group(function() {
        // Rute lama Anda (placeholder)
        Route::post('/barter', function() { return 'Proses Barter'; })->name('barter');
        Route::post('/pindah', function() { return 'Proses Pindah'; })->name('pindah');

        // ===================================
        // == RUTE CHARTER BARU ==
        // ===================================
        // Rute untuk menampilkan form charter
        // Kita akan mengirim ID Shift dari slot kosong ke form ini
        Route::get('/charter/create/{shift}', [CharterController::class, 'create'])->name('charter.create');

        // Rute untuk MENYIMPAN data charter dari form
        Route::post('/charter/store', [CharterController::class, 'store'])->name('charter.store');
     });
    
Route::get('/mahasiswa/{id}', [App\Http\Controllers\MahasiswaController::class, 'show'])->name('mahasiswa.show');

}); // <-- Ini penutup middleware 'auth', 'verified'

// File rute otentikasi (login, register, dll)
require __DIR__.'/auth.php';