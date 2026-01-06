<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruang; // Import Model Ruang
use Illuminate\Http\Request;

class RuangCrudController extends Controller
{
    /**
     * READ: Menampilkan semua ruang
     */
    public function index()
    {
        $ruangs = Ruang::orderBy('nama_ruang')->paginate(10);
        return view('admin.ruang.index', compact('ruangs'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah ruang
     */
    public function create()
    {
        return view('admin.ruang.create');
    }

    /**
     * CREATE (STORE): Menyimpan data ruang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:100|unique:ruangs',
        ]);

        Ruang::create($request->all());

        return redirect()->route('admin.ruangs.index')
                         ->with('success', 'Ruang baru berhasil ditambahkan.');
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit ruang
     */
    public function edit(Ruang $ruang)
    {
        return view('admin.ruang.edit', compact('ruang'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data ruang
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:100|unique:ruangs,nama_ruang,' . $ruang->id,
        ]);

        $ruang->update($request->all());

        return redirect()->route('admin.ruangs.index')
                         ->with('success', 'Data Ruang berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data ruang
     */
    public function destroy(Ruang $ruang)
    {
        try {
            $ruang->delete();
            return redirect()->route('admin.ruangs.index')
                             ->with('success', 'Data Ruang berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.ruangs.index')
                             ->with('error', 'Data Ruang tidak bisa dihapus karena masih digunakan di tabel jadwal.');
        }
    }
}