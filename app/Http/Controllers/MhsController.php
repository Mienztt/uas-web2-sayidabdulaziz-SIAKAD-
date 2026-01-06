<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mhs; // <-- PENTING: Panggil Model yang tadi dibuat

class MhsController extends Controller
{
    public function index()
    {
        // Ambil semua data mahasiswa
        $data = Mhs::all();
        
        // Kirim ke View
        return view('mahasiswa', compact('data'));
    }
    public function cari(Request $request)
    {
        $keyword = $request->keyword;

        // Logika pencarian: NIM ATAU Nama ATAU Jurusan
        $data = Mhs::where('nim', 'like', "%" . $keyword . "%")
                    ->orWhere('nama', 'like', "%" . $keyword . "%")
                    ->orWhere('jurusan', 'like', "%" . $keyword . "%") // Asumsi kolom prodi = jurusan
                    ->get();

        // Kita kembalikan dalam bentuk View Partial (bukan JSON, bukan full page)
        return view('tabel_mhs', compact('data'))->render();
    }
}
