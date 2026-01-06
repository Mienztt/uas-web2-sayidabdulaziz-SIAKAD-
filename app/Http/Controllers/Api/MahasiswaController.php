<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // <-- 1. TAMBAHKAN INI

class MahasiswaController extends Controller
{
    /**
     * GET /api/mahasiswa
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        
        return response()->json([
            'status' => true,
            'message' => 'Data Mahasiswa Berhasil Diambil',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * POST /api/mahasiswa
     */
    public function store(Request $request)
    {
        // 2. HAPUS tanda backslash (\) di depan Validator
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'prodi_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'prodi_id' => $request->prodi_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Mahasiswa Berhasil Ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    /**
     * GET /api/mahasiswa/{id}
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail Data Mahasiswa',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * PUT /api/mahasiswa/{id}
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $mahasiswa->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Mahasiswa Berhasil Diupdate',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * DELETE /api/mahasiswa/{id}
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Mahasiswa Berhasil Dihapus'
        ], 200);
    }
}