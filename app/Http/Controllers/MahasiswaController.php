<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('prodi', 'dosenPembimbing');

        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('nim', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('prodi', function($q) use ($keyword) {
                      $q->where('nama_prodi', 'LIKE', "%{$keyword}%");
                  });
            });
        }

        $mahasiswa = $query->latest()->paginate(10);
        
        // Tetap arahkan ke folder view 'mahasiswa'
        return view('mahasiswa.index', compact('mahasiswa')); 
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi', 'dosenPembimbing')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        $dosens = Dosen::all();
        return view('mahasiswa.create', compact('prodi', 'dosens')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
            'dosen_pembimbing_id' => 'nullable|exists:dosens,id',
            'gambar_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_profil')) {
            $path = $request->file('gambar_profil')->store('profiles', 'public');
            $data['gambar_profil'] = $path;
        }

        Mahasiswa::create($data);

        // Berhasil: Kembali ke index admin
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodi = Prodi::all();
        $dosens = Dosen::all(); 
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
            'dosen_pembimbing_id' => 'nullable|exists:dosens,id',
            'gambar_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_profil')) {
            if ($mahasiswa->gambar_profil) {
                Storage::disk('public')->delete($mahasiswa->gambar_profil);
            }
            $path = $request->file('gambar_profil')->store('profiles', 'public');
            $data['gambar_profil'] = $path;
        }

        $mahasiswa->update($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Profil Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        if ($mahasiswa->gambar_profil) {
            Storage::disk('public')->delete($mahasiswa->gambar_profil);
        }
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Dihapus!');
    }
}