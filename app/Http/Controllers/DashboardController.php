<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\User;               
use App\Models\Mahasiswa;         
use App\Models\Dosen;  // Tambahkan ini
use App\Models\Mk;     // Tambahkan ini agar MK bisa dihitung
use App\Models\Jadwal;             
use App\Models\Kelas;               

class DashboardController extends Controller
{
    public function index()
    {
      $totalDosen = Dosen::count(); 
    $totalMahasiswa = Mahasiswa::count();
    $totalKelas = Kelas::count(); // <--- Variabel ini sudah ada
    $totalMk = Mk::count(); 
    $totalJadwal = Jadwal::count();

    // Logika Chart (Tetap sama)
    $jadwalPerHari = DB::table('jadwal')
        ->join('shifts', 'jadwal.shift_id', '=', 'shifts.id')
        ->select('shifts.hari', DB::raw('count(*) as total'))
        ->groupBy('shifts.hari')
        ->orderByRaw("FIELD(shifts.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
        ->pluck('total', 'hari'); 

    $chartLabels = $jadwalPerHari->keys();
    $chartValues = $jadwalPerHari->values();

    // BAGIAN PENTING: Tambahkan 'totalKelas' di sini
    return view('dashboard', compact(
        'totalDosen', 
        'totalMahasiswa', 
        'totalKelas', // <--- HARUS ADA DI SINI
        'totalMk', 
        'totalJadwal',
        'chartLabels',
        'chartValues'
    ));
    }
}