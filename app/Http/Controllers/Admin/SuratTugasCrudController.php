<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratTugasMengajar;
use App\Models\User;  // <-- Import User
use App\Models\Mk;    // <-- Import Mk
use App\Models\Kelas; // <-- Import Kelas
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratTugasCrudController extends Controller
{
    /**
     * READ: Menampilkan semua surat tugas
     */
    public function index()
    {
        $suratTugas = SuratTugasMengajar::with(['dosen', 'mataKuliah', 'kelas'])
                                        ->latest()
                                        ->paginate(10);
        return view('admin.surat_tugas.index', compact('suratTugas'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah surat tugas
     */
    public function create()
    {
        // Ambil data untuk dropdown
        $dosens = User::role('Dosen')->orderBy('name')->get();
        $mks = Mk::orderBy('nama_mk')->get();
        $kelas = Kelas::orderBy('nama')->get();

        return view('admin.surat_tugas.create', compact('dosens', 'mks', 'kelas'));
    }

    /**
     * CREATE (STORE): Menyimpan data surat tugas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:users,id',
            'mata_kuliah_id' => 'required|exists:mks,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        SuratTugasMengajar::create($request->all());

        return redirect()->route('admin.surat-tugas.index')
                         ->with('success', 'Surat Tugas Mengajar baru berhasil dibuat.');
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit surat tugas
     */
    public function edit(SuratTugasMengajar $suratTuga) // Laravel 11/12 bind otomatis
    {
        $suratTugas = $suratTuga;
        
        // Data untuk dropdown
        $dosens = User::role('Dosen')->orderBy('name')->get();
        $mks = Mk::orderBy('nama_mk')->get();
        $kelas = Kelas::orderBy('nama')->get();

        return view('admin.surat_tugas.edit', compact('suratTugas', 'dosens', 'mks', 'kelas'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data surat tugas
     */
    public function update(Request $request, SuratTugasMengajar $suratTuga)
    {
        $suratTugas = $suratTuga;
        $request->validate([
            'dosen_id' => 'required|exists:users,id',
            'mata_kuliah_id' => 'required|exists:mks,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $suratTugas->update($request->all());

        return redirect()->route('admin.surat-tugas.index')
                         ->with('success', 'Surat Tugas Mengajar berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data surat tugas
     */
    public function destroy(SuratTugasMengajar $suratTuga)
    {
        $suratTugas = $suratTuga;
        try {
            $suratTugas->delete();
            return redirect()->route('admin.surat-tugas.index')
                             ->with('success', 'Surat Tugas Mengajar berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.surat-tugas.index')
                             ->with('error', 'Surat Tugas tidak bisa dihapus karena masih digunakan di tabel jadwal.');
        }
    }

    public function cetakPdf(SuratTugasMengajar $suratTuga)
{
    $suratTugas = $suratTuga->load(['dosen', 'mataKuliah', 'kelas']);
    $detailMatakuliah = [
       
        ['no' => 1, 'nama' => $suratTugas->mataKuliah->nama_mk, 'sks' => 3, 'program' => 'S1 SI', 'smt' => 3, 'kelas' => 'R/NR', 'jml_kelas' => 2, 'jml_sks' => 6],
        // ... data lain bisa ditambahkan di sini
    ];

    // Buat nama file PDF
    $fileName = 'Surat Tugas - ' . $suratTugas->dosen->name . '.pdf';

    $pdf = Pdf::loadView('admin.surat_tugas.pdf', [
        'suratTugas' => $suratTugas,
        'detailMatakuliah' => $detailMatakuliah,
        'nomorSurat' => '654/FKOM-UM/IX/2025', // Contoh dari PDF 
        'tanggalSurat' => '03 September 2025' // Contoh dari PDF 
    ]);

    // Tampilkan PDF di browser
    return $pdf->stream($fileName);
}
}