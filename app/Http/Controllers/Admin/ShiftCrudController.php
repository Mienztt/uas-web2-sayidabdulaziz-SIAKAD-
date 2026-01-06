<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift; // Import Model Shift
use Illuminate\Http\Request;

class ShiftCrudController extends Controller
{
    /**
     * READ: Menampilkan semua shift
     */
    public function index()
    {
        $shifts = Shift::orderBy('hari')->orderBy('jam_mulai')->paginate(10);
        return view('admin.shift.index', compact('shifts'));
    }

    /**
     * CREATE (FORM): Menampilkan formulir tambah shift
     */
    public function create()
    {
        return view('admin.shift.create');
    }

    /**
     * CREATE (STORE): Menyimpan data shift baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'prodi' => 'required|string|max:100',
        ]);

        Shift::create($request->all());

        return redirect()->route('admin.shifts.index')
                         ->with('success', 'Shift baru berhasil ditambahkan.');
    }

    /**
     * UPDATE (FORM): Menampilkan formulir edit shift
     */
    public function edit(Shift $shift)
    {
        return view('admin.shift.edit', compact('shift'));
    }

    /**
     * UPDATE (SAVE): Menyimpan perubahan data shift
     */
    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'prodi' => 'required|string|max:100',
        ]);

        $shift->update($request->all());

        return redirect()->route('admin.shifts.index')
                         ->with('success', 'Data Shift berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data shift
     */
    public function destroy(Shift $shift)
    {
        try {
            $shift->delete();
            return redirect()->route('admin.shifts.index')
                             ->with('success', 'Data Shift berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.shifts.index')
                             ->with('error', 'Data Shift tidak bisa dihapus karena masih digunakan di tabel jadwal.');
        }
    }
}