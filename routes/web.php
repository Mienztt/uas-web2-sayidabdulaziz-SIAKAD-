<?php

use Illuminate\Support\Facades\Route;
use App\Models\Mhs;
use App\Http\Controllers\{
    MahasiswaController, MhsController, ProfileController, 
    JadwalController, DashboardController
};
use App\Http\Controllers\Admin\{
    JadwalCrudController, DosenCrudController, MkCrudController,
    RuangCrudController, ShiftCrudController, KelasCrudController,
    SuratTugasCrudController
};
use App\Http\Controllers\Dosen\CharterController;
use App\Http\Controllers\Admin\SuratTugasController;    

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. RUTE PUBLIK ---
Route::get('/', function () {
    $data = Mhs::all();
    return view('welcome', compact('data'));
});
Route::get('/cari-mhs', [MhsController::class, 'cari'])->name('mhs.cari');


// --- 2. RUTE TERPROTEKSI (WAJIB LOGIN) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard & Profile (Semua Role Bisa Akses)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // --- 3. KHUSUS MAHASISWA & DOSEN (Melihat Jadwal) ---
    Route::get('/jadwal', [JadwalController::class, 'index'])
        ->middleware(['role:Dekan|Kaprodi|Sekprodi|Dosen|Mahasiswa']) 
        ->name('jadwal');

    // Mahasiswa hanya bisa melihat profilnya sendiri (atau detail mahasiswa lain)
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');


    // --- 4. KHUSUS DOSEN (Actions) ---
    Route::middleware(['role:Dosen'])
        ->prefix('dosen-actions')
        ->name('dosen.')
        ->group(function() {
            Route::post('/barter', function() { return 'Proses Barter'; })->name('barter');
            Route::post('/pindah', function() { return 'Proses Pindah'; })->name('pindah');
            
            // Charter Routes
            Route::get('/charter/create/{shift}', [CharterController::class, 'create'])->name('charter.create');
            Route::post('/charter/store', [CharterController::class, 'store'])->name('charter.store');
        });


    // --- 5. KHUSUS ADMIN (DEKAN, KAPRODI, SEKPRODI) ---
    // Mahasiswa TIDAK BISA masuk ke sini sama sekali
    Route::middleware(['role:Dekan|Kaprodi|Sekprodi', 'auth-group'])->prefix('admin')->name('admin.')->group(function () {
        
        // Data Mahasiswa (Hanya Admin/Dosen yang bisa lihat list semua mahasiswa)
        Route::resource('mahasiswa', MahasiswaController::class)->except(['show']); 

        // Master Data CRUD
        Route::resource('jadwal', JadwalCrudController::class);
        Route::resource('dosens', DosenCrudController::class);
        Route::resource('mks', MkCrudController::class);
        Route::resource('ruangs', RuangCrudController::class);
        Route::resource('shifts', ShiftCrudController::class);
        Route::resource('kelas', KelasCrudController::class);

       Route::resource('surat-tugas', SuratTugasController::class);
    
    // Rute Print (Gunakan nama 'print' agar sesuai dengan controller yang kita buat tadi)
   Route::get('surat-tugas/{id}/print', [SuratTugasController::class, 'print'])->name('surat-tugas.print');

        // Contoh Rute Sensitif
        Route::get('/finansial', function () {
            return 'ANDA TIDAK SEHARUSNYA MELIHAT INI!';
        })->middleware('auth-group-sensitif')->name('finansial');
    });

});

require __DIR__.'/auth.php';