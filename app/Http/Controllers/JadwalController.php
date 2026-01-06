<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Jadwal;
use App\Models\Shift; 

class JadwalController extends Controller
{
    public function index(): View
    {
        $jadwals = Jadwal::with(['mk', 'dosen', 'ruang', 'shift'])->get();
        $tabelJadwal = $jadwals->groupBy(function($item) {
            return $item->shift->hari; 
        })->map(function($hari) {
            // Di dalam setiap hari, kelompokkan lagi berdasarkan Prodi
            return $hari->groupBy(function($item) {
                return $item->shift->prodi; // 'S1 SI', 'D3 KA', dst.
            });
        });
        $shifts = Shift::all()->groupBy('hari');
        // 3. Kirim data yang sudah terstruktur rapi ke view
        return view('jadwal.index', [
            'tabelJadwal' => $tabelJadwal,
            'shifts' => $shifts
        ]);
    }
}