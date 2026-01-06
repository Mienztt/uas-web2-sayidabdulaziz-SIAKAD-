<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen; // Import Model Dosen
use Illuminate\Http\Request;

class DosenCrudController extends Controller
{
    /**
     * READ: Menampilkan semua dosen
     */
    public function index()
    {
        $dosens = Dosen::orderBy('nama_dosen')->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah dosen
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * CREATE (STORE): Menyimpan data dosen baru
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_dosen' => 'required|string|max:255|unique:dosens',
            'inisial' => 'nullable|string|max:10',
        ]);

        // Simpan ke database
        Dosen::create($request->all());

        return redirect()->route('admin.dosens.index')
                         ->with('success', 'Dosen baru berhasil ditambahkan.');
    }

    /**
     * (Method 'show' tidak kita gunakan untuk saat ini)
     */
    public function show(Dosen $dosen)
    {
        return abort(404);
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit dosen
     */
    public function edit(Dosen $dosen)
    {
        // $dosen diambil otomatis oleh Laravel (Route Model Binding)
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data dosen
     */
    public function update(Request $request, Dosen $dosen)
    {
        // Validasi
        $request->validate([
            // 'unique' diabaikan jika nama_dosen tidak berubah
            'nama_dosen' => 'required|string|max:255|unique:dosens,nama_dosen,' . $dosen->id,
            'inisial' => 'nullable|string|max:10',
        ]);

        // Update data
        $dosen->update($request->all());

        return redirect()->route('admin.dosens.index')
                         ->with('success', 'Data Dosen berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data dosen
     */
    public function destroy(Dosen $dosen)
    {
        try {
            $dosen->delete();
            return redirect()->route('admin.dosens.index')
                             ->with('success', 'Data Dosen berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Menangkap error jika dosen masih terpakai di tabel 'jadwal'
            return redirect()->route('admin.dosens.index')
                             ->with('error', 'Data Dosen tidak bisa dihapus karena masih digunakan di tabel jadwal.');
        }
    }
}