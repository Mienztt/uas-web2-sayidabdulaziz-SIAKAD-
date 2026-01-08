<?php

namespace App\Http\Controllers\Admin; // Sesuaikan jika kamu pakai folder Admin

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Tampilan List Dosen dengan Pencarian
     */
    public function index(Request $request)
    {
        $query = Dosen::with('user');

        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where('nama_dosen', 'LIKE', "%{$keyword}%")
                  ->orWhere('nidn', 'LIKE', "%{$keyword}%");
        }

        $dosens = $query->orderBy('nama_dosen')->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Simpan Dosen + Buat Akun User Otomatis
     */
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama_dosen' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'inisial' => 'nullable|string|max:10', // Tambahkan ini
        ]);

        DB::transaction(function () use ($request) {
            // 1. Buat User Login
            $user = User::create([
                'name' => $request->nama_dosen,
                'email' => $request->email,
                'password' => Hash::make('password123'), // Password default
            ]);

            // 2. Berikan Role Dosen (Spatie)
            $user->assignRole('Dosen');

            // 3. Simpan ke Tabel Dosen
            Dosen::create([
                'nidn' => $request->nidn,
    'nama_dosen' => $request->nama_dosen,
    'inisial' => $request->inisial, // Tambahkan ini agar tersimpan
    'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin.dosens.index')->with('success', 'Dosen dan Akun Login berhasil dibuat!');
    }

    public function edit($id)
    {
        // Ambil data dosen beserta user-nya untuk diedit emailnya
        $dosen = Dosen::with('user')->findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * Update Dosen + Sinkronkan dengan data User-nya
     */
    public function update(Request $request, $id)
    {
   $dosen = Dosen::findOrFail($id);
    
    // Cari user. Kalau user_id null, $user akan bernilai null
    $user = User::find($dosen->user_id);

    $request->validate([
        'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
        'nama_dosen' => 'required|string|max:255',
        // Jika user baru (null), abaikan pengecekan ID di unique
        'email' => 'required|email|unique:users,email,' . ($user->id ?? 'NULL'),
        'inisial' => 'nullable|string|max:10',
    ]);

    DB::transaction(function () use ($request, $dosen, $user) {
        // JIKA DOSEN BELUM PUNYA AKUN (Data Lama)
        if (!$user) {
            $newUser = User::create([
                'name' => $request->nama_dosen,
                'email' => $request->email,
                'password' => Hash::make('password123'),
            ]);
            $newUser->assignRole('Dosen');
            
            // Pasangkan ID user baru ke record dosen
            $dosen->user_id = $newUser->id;
        } else {
            // JIKA SUDAH ADA AKUN, UPDATE SAJA
            $user->update([
                'name' => $request->nama_dosen,
                'email' => $request->email,
            ]);
        }

        // Simpan semua perubahan profil dosen
        $dosen->update([
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'inisial' => $request->inisial,
            'user_id' => $dosen->user_id, // Penting agar user_id tersimpan
        ]);
    });

    return redirect()->route('admin.dosens.index')->with('success', 'Data Dosen dan Akun berhasil diperbarui!');
    }

    /**
     * Hapus Dosen + Hapus Akun User-nya
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        
        DB::transaction(function () use ($dosen) {
            // Hapus User-nya dulu jika ada
            if ($dosen->user_id) {
                User::where('id', $dosen->user_id)->delete();
            }
            // Hapus Dosennya
            $dosen->delete();
        });

        return redirect()->route('admin.dosens.index')->with('success', 'Dosen dan Akun terkait berhasil dihapus!');
    }
}