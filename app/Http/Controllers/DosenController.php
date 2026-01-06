<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:dosen,email',
            'no_telp' => 'nullable|string|max:15',
        ]);

        Dosen::create($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
    }

    public function show($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.show', compact('dosen'));
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nidn' => 'required|unique:dosen,nidn,' . $dosen->id,
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:dosen,email,' . $dosen->id,
            'no_telp' => 'nullable|string|max:15',
        ]);

        $dosen->update($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
    }
}
