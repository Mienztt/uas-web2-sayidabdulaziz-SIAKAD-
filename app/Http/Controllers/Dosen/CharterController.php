<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Ruang;
use App\Models\Shift;
use App\Models\SuratTugasMengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharterController extends Controller
{
    /**
     * Menampilkan formulir untuk charter slot.
     */
    public function create(Shift $shift)
    {
        // Ambil ID dosen yang sedang login
        $dosenId = Auth::id();

        // 1. Ambil Surat Tugas milik dosen ini YANG BELUM TERJADWAL
        $suratTugasList = SuratTugasMengajar::where('dosen_id', $dosenId)
                            ->whereDoesntHave('jadwal') // Cek surat tugas yang belum punya jadwal
                            ->with('mataKuliah', 'kelas')
                            ->get();

        // 2. Ambil semua ruangan yang tersedia
        $ruangs = Ruang::orderBy('nama_ruang')->get();

        // 3. Kirim data ke view
        return view('dosen.charter.create', compact('shift', 'suratTugasList', 'ruangs'));
    }

    /**
     * Menyimpan data charter baru (membuat Jadwal baru).
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'surat_tugas_id' => 'required|exists:surat_tugas_mengajar,id',
            'shift_id' => 'required|exists:shifts,id',
            'ruang_id' => 'required|exists:ruangs,id',
        ]);

        // 2. Cek Bentrok 
        // Cek apakah sudah ada jadwal di Shift DAN Ruangan yang sama
        $isBentrok = Jadwal::where('shift_id', $request->shift_id)
                           ->where('ruang_id', $request->ruang_id)
                           ->exists();

        if ($isBentrok) {
            // Jika bentrok, kembalikan dengan pesan error 
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal Charter! Slot di ruangan tersebut sudah terisi pada jam yang sama.');
        }

        // Cek bentrok Dosen (apakah dosen ini sudah mengajar di shift yang sama di ruang lain)
        $dosenBentrok = Jadwal::where('shift_id', $request->shift_id)
                              ->whereHas('suratTugas', function($q) {
                                  $q->where('dosen_id', Auth::id());
                              })->exists();

        if ($dosenBentrok) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal Charter! Anda sudah memiliki jadwal lain di jam yang sama.');
        }


        // 3. Ambil Surat Tugas untuk link ke Dosen ID
        $suratTugas = SuratTugasMengajar::find($request->surat_tugas_id);

        // 4. Buat Jadwal Baru
        Jadwal::create([
            'surat_tugas_mengajar_id' => $request->surat_tugas_id,
            'dosen_id' => $suratTugas->dosen_id, // Ambil dari Surat Tugas
            'mk_id' => $suratTugas->mata_kuliah_id, // Ambil dari Surat Tugas
            'shift_id' => $request->shift_id,
            'ruang_id' => $request->ruang_id,
        ]);

        // 5. Redirect ke halaman jadwal utama
        return redirect()->route('jadwal')
                         ->with('success', 'Jadwal berhasil di-charter!');
    }
}