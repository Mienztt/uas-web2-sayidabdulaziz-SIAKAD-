<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- TAMBAHKAN INI (Wajib)
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
     * CREATE (STORE): Menyimpan data dosen baru + Buat Akun User
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama_dosen' => 'required',
            'email' => 'required|email|unique:users,email',
            // sesuaikan dengan field di tabel dosens kamu
        ]);

        try {
            // Gunakan Database Transaction agar aman
            DB::transaction(function () use ($request) {
                
                // 2. Buat Akun User untuk Login
                $user = User::create([
                    'name' => $request->nama_dosen,
                    'email' => $request->email,
                    'password' => Hash::make('password123'), // Password default
                ]);

                // 3. Berikan Role Dosen (Menggunakan Spatie)
                $user->assignRole('Dosen');

                // 4. Simpan ke Tabel Dosen
                Dosen::create([
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->nama_dosen,
                    'user_id' => $user->id, // Menghubungkan ke ID User yang baru dibuat
                ]);
            });

            return redirect()->route('admin.dosens.index')->with('success', 'Dosen dan Akun Login (password: password123) berhasil dibuat!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * UPDATE (FORM)
     */
    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    /**
     * UPDATE (SAVE)
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
        ]);

        $dosen->update($request->all());

        return redirect()->route('admin.dosens.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function destroy(Dosen $dosen)
    {
        try {
            // Jika ingin menghapus user-nya juga saat dosen dihapus:
            // if ($dosen->user_id) { User::find($dosen->user_id)->delete(); }
            
            $dosen->delete();
            return redirect()->route('admin.dosens.index')->with('success', 'Data Dosen berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.dosens.index')->with('error', 'Gagal hapus! Dosen masih terkait dengan data lain (seperti jadwal).');
        }
    }
}