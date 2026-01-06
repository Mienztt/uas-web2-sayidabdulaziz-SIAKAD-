<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Shift; 
use App\Models\Dosen; // Menggunakan Model Dosen
use App\Models\Ruang;
use App\Models\Mk;    // Menggunakan Model Mk
use Illuminate\Http\Request;

class JadwalCrudController extends Controller
{
    /**
     * Menampilkan daftar jadwal dengan pencarian yang sudah diperbaiki.
     * Menghapus pencarian kolom 'prodi' karena tidak ada di database.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $jadwals = Jadwal::query()
            ->with(['dosen', 'mk', 'ruang', 'shift'])
            ->when($keyword, function ($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->whereHas('dosen', function ($sq) use ($keyword) {
                        // Mencari berdasarkan nama dosen di tabel dosens
                        $sq->where('nama_dosen', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('mk', function ($sq) use ($keyword) {
                        // Mencari berdasarkan nama mata kuliah di tabel mks
                        $sq->where('nama_mk', 'like', '%' . $keyword . '%');
                    });
                    // Kolom 'prodi' dihapus dari sini karena menyebabkan error 1054
                });
            })
            ->latest()
            ->paginate(10);
            
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Form tambah jadwal dengan data dropdown dari tabel masing-masing.
     */
    public function create()
    {
        $mks = Mk::all();
        $dosens = Dosen::all(); // Mengambil semua data dari tabel dosens
        $ruangs = Ruang::all();
        $shifts = Shift::all();
        
        return view('admin.jadwal.create', compact('mks', 'dosens', 'ruangs', 'shifts'));
    }

    /**
     * Simpan jadwal baru dengan Validasi Penjadwalan Cerdas.
     */
    public function store(Request $request)
    {
        // Menghapus 'prodi' dari validasi agar tidak error
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mk_id' => 'required|exists:mks,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);
        
        // Logika Smart Scheduling: Cek Konflik Dosen
        $konflikDosen = Jadwal::where('dosen_id', $request->dosen_id)
            ->where('shift_id', $request->shift_id)
            ->exists();

        if ($konflikDosen) {
            return redirect()->back()->withInput()->withErrors(['dosen_id' => "Dosen yang dipilih sudah memiliki jadwal di jam tersebut."]);
        }

        // Logika Smart Scheduling: Cek Konflik Ruangan
        $konflikRuang = Jadwal::where('ruang_id', $request->ruang_id)
            ->where('shift_id', $request->shift_id)
            ->exists();

        if ($konflikRuang) {
            return redirect()->back()->withInput()->withErrors(['ruang_id' => "Ruangan tersebut sudah digunakan oleh mata kuliah lain di jam yang sama."]);
        }

        // Simpan hanya kolom yang ada di database
        Jadwal::create($request->only(['dosen_id', 'mk_id', 'ruang_id', 'shift_id']));

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal.
     */
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $mks = Mk::all();
        $dosens = Dosen::all(); 
        $ruangs = Ruang::all();
        $shifts = Shift::all();

        return view('admin.jadwal.edit', compact('jadwal', 'mks', 'dosens', 'ruangs', 'shifts'));
    }

    /**
     * Update jadwal dengan pengecekan konflik (mengabaikan ID sendiri).
     */
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'mk_id' => 'required|exists:mks,id',
            'ruang_id' => 'required|exists:ruangs,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);

        // Cek Konflik Dosen (Kecuali jadwal yang sedang diedit)
        $konflikDosen = Jadwal::where('dosen_id', $request->dosen_id)
            ->where('shift_id', $request->shift_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($konflikDosen) {
            return redirect()->back()->withInput()->withErrors(['dosen_id' => "Gagal Update: Dosen memiliki jadwal lain di jam ini."]);
        }

        // Cek Konflik Ruangan (Kecuali jadwal yang sedang diedit)
        $konflikRuang = Jadwal::where('ruang_id', $request->ruang_id)
            ->where('shift_id', $request->shift_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($konflikRuang) {
            return redirect()->back()->withInput()->withErrors(['ruang_id' => "Gagal Update: Ruangan sudah terpakai."]);
        }

        $jadwal->update($request->only(['dosen_id', 'mk_id', 'ruang_id', 'shift_id']));

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Menghapus jadwal.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}