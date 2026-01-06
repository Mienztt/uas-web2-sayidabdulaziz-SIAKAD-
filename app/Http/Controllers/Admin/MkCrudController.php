<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mk; // Import Model Mk
use Illuminate\Http\Request;

class MkCrudController extends Controller
{
    /**
     * READ: Menampilkan semua mata kuliah
     */
    public function index()
    {
        $mks = Mk::orderBy('nama_mk')->paginate(10);
        return view('admin.mk.index', compact('mks'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah mk
     */
    public function create()
    {
        return view('admin.mk.create');
    }

    /**
     * CREATE (STORE): Menyimpan data mk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255|unique:mks',
            'kode_mk' => 'nullable|string|max:20',
            'sks' => 'nullable|integer|min:0',
        ]);

        Mk::create($request->all());

        return redirect()->route('admin.mks.index')
                         ->with('success', 'Mata Kuliah baru berhasil ditambahkan.');
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit mk
     */
    public function edit(Mk $mk)
    {
        return view('admin.mk.edit', compact('mk'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data mk
     */
    public function update(Request $request, Mk $mk)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255|unique:mks,nama_mk,' . $mk->id,
            'kode_mk' => 'nullable|string|max:20',
            'sks' => 'nullable|integer|min:0',
        ]);

        $mk->update($request->all());

        return redirect()->route('admin.mks.index')
                         ->with('success', 'Data Mata Kuliah berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data mk
     */
    public function destroy(Mk $mk)
    {
        try {
            $mk->delete();
            return redirect()->route('admin.mks.index')
                             ->with('success', 'Data Mata Kuliah berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.mks.index')
                             ->with('error', 'Data Mata Kuliah tidak bisa dihapus karena masih digunakan di tabel jadwal.');
        }
    }
}