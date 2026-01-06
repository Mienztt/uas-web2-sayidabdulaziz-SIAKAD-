<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas; // Import Model Kelas
use Illuminate\Http\Request;

class KelasCrudController extends Controller
{
    /**
     * READ: Menampilkan semua kelas
     */
    public function index()
    {
        $kelas = Kelas::orderBy('angkatan', 'desc')->orderBy('nama')->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah kelas
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * CREATE (STORE): Menyimpan data kelas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kelas', // [cite: 81]
            'angkatan' => 'required|digits:4', // [cite: 82, 86]
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas baru berhasil ditambahkan.');
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit kelas
     */
    public function edit(Kelas $kela) // Laravel akan otomatis bind $kelas
    {
        $kelas = $kela; // Ganti nama variabel agar konsisten
        return view('admin.kelas.edit', compact('kelas'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data kelas
     */
    public function update(Request $request, Kelas $kela)
    {
        $kelas = $kela;
        $request->validate([
            'nama' => 'required|string|max:100|unique:kelas,nama,' . $kelas->id, // [cite: 81]
            'angkatan' => 'required|digits:4', // [cite: 82, 86]
        ]);

        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Data Kelas berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data kelas
     */
    public function destroy(Kelas $kela)
    {
        $kelas = $kela;
        try {
            $kelas->delete();
            return redirect()->route('admin.kelas.index')
                             ->with('success', 'Data Kelas berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.kelas.index')
                             ->with('error', 'Data Kelas tidak bisa dihapus karena masih digunakan di tabel lain (Surat Tugas).');
        }
    }
}