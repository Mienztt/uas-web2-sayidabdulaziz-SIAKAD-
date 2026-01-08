<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratTugas;
use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    /**
     * Tampilkan semua daftar surat tugas
     */
    public function index()
    {
        $surats = SuratTugas::with('dosen')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.surat-tugas.index', compact('surats'));
    }

    /**
     * Form tambah surat tugas
     */
    public function create()
    {
     // Ambil data Dosen
    $dosens = \App\Models\Dosen::orderBy('nama_dosen', 'asc')->get();
    
    // Ambil data Mata Kuliah
    $mks = \App\Models\Mk::orderBy('nama_mk', 'asc')->get();

    // AMBIL DATA KELAS (Ini yang bikin error tadi)
    $kelas = \App\Models\Kelas::orderBy('nama_kelas', 'asc')->get();

    // Kirim SEMUA variabel ke view lewat compact
    return view('admin.surat-tugas.create', compact('dosens', 'mks', 'kelas'));
    }

    /**
     * Simpan surat tugas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|unique:surat_tugas,nomor_surat',
            'dosen_id' => 'required|exists:dosens,id',
            'semester_aktif' => 'required|string',
            'tanggal_terbit' => 'required|date',
        ]);

        SuratTugas::create($request->all());

        return redirect()->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil dibuat!');
    }

    /**
     * Form edit surat tugas
     */
    public function edit($id)
    {
        $surat = SuratTugas::findOrFail($id);
        $dosens = Dosen::orderBy('nama_dosen', 'asc')->get();
        return view('admin.surat-tugas.edit', compact('surat', 'dosens'));
    }

    /**
     * Update data surat tugas
     */
    public function update(Request $request, $id)
    {
        $surat = SuratTugas::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|unique:surat_tugas,nomor_surat,' . $surat->id,
            'dosen_id' => 'required|exists:dosens,id',
            'semester_aktif' => 'required|string',
            'tanggal_terbit' => 'required|date',
        ]);

        $surat->update($request->all());

        return redirect()->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil diperbarui!');
    }

    /**
     * Hapus surat tugas
     */
    public function destroy($id)
    {
        $surat = SuratTugas::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat-tugas.index')
        ->with('success', 'Surat Tugas berhasil dihapus!');
    }

    /**
     * Fungsi Cetak ke Format PDF/Print (Sesuai Contoh Ma'soem)
     */
    public function print($id)
    {
        // 1. Ambil data surat dan dosennya
        $surat = SuratTugas::with('dosen')->findOrFail($id);
        
        // 2. Ambil jadwal dosen tersebut, lalu kelompokkan berdasarkan Mata Kuliah
        // Eager load 'mk' agar kita bisa tahu SKS-nya
        $jadwalDosen = Jadwal::where('dosen_id', $surat->dosen_id)
            ->with('mk')
            ->get()
            ->groupBy('mk_id'); 

        /**
         * Penjelasan Logika GroupBy:
         * Jika Dosen mengajar 'Pemrograman Web' di 3 kelas berbeda, 
         * maka di tabel print akan muncul 1 baris 'Pemrograman Web' 
         * dengan 'Jml Kelas' = 3 dan 'Total SKS' = (SKS MK * 3).
         */

        return view('admin.surat-tugas.print', compact('surat', 'jadwalDosen'));
    }
}