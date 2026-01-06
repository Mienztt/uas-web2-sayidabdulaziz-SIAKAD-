<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Dosen;            // <-- FIX: Gunakan Model Dosen sesuai tabel 'dosens' Anda
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Menggunakan paginate agar tampilan list lebih rapi jika data banyak
        $mahasiswa = Mahasiswa::with('prodi', 'dosenPembimbing')->paginate(10); 
        return view('mahasiswa.index', compact('mahasiswa')); 
    }

    // --- FITUR BARU: HALAMAN DETAIL ---
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi', 'dosenPembimbing')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        $dosens = Dosen::all(); // <-- FIX: Ambil dari tabel 'dosens'
        return view('mahasiswa.create', compact('prodi', 'dosens')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
            'dosen_pembimbing_id' => 'nullable|exists:dosens,id', // <-- FIX: Cek ke tabel dosens
            'gambar_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_profil')) {
            // Folder penyimpanan diubah ke 'profiles' agar lebih spesifik
            $path = $request->file('gambar_profil')->store('profiles', 'public');
            $data['gambar_profil'] = $path;
        }

        Mahasiswa::create($data);

        return redirect()->route('web.mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan!');
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
            // LOGIKA REPLACE: Hapus file lama jika user upload foto baru
            if ($mahasiswa->gambar_profil) {
                Storage::disk('public')->delete($mahasiswa->gambar_profil);
            }
            $path = $request->file('gambar_profil')->store('profiles', 'public');
            $data['gambar_profil'] = $path;
        }

        $mahasiswa->update($data);

        return redirect()->route('web.mahasiswa.index')->with('success', 'Data Profil Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Hapus file dari storage saat data dihapus dari database
        if ($mahasiswa->gambar_profil) {
            Storage::disk('public')->delete($mahasiswa->gambar_profil);
        }

        $mahasiswa->delete();
        return redirect()->route('web.mahasiswa.index')->with('success', 'Data Mahasiswa dan Foto Berhasil Dihapus!');
    }
}