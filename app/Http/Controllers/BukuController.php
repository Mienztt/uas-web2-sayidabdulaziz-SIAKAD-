<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
         return view('buku.index', compact('buku'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|min:3',
            'pengarang' => 'required|string|min:3',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ]);
        Buku::create($validatedData);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
