<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\User;               
use App\Models\Mahasiswa;        
use App\Models\Jadwal;            
use App\Models\Kelas;              


class DashboardController extends Controller
{
    public function index()
    {
        
        $totalDosen = User::role('Dosen')->count(); 
        $totalMahasiswa = Mahasiswa::count();
        $totalKelas = Kelas::count();
        $totalJadwal = Jadwal::count();

        
        $jadwalPerHari = DB::table('jadwal')
            ->join('shifts', 'jadwal.shift_id', '=', 'shifts.id')
            ->select('shifts.hari', DB::raw('count(*) as total'))
            ->groupBy('shifts.hari')
            
            ->pluck('total', 'hari'); 

        
        $chartLabels = $jadwalPerHari->keys();
        $chartValues = $jadwalPerHari->values();

        return view('dashboard', compact(
            'totalDosen', 
            'totalMahasiswa', 
            'totalKelas', 
            'totalJadwal',
            'chartLabels',
            'chartValues'
        ));
    }
}
