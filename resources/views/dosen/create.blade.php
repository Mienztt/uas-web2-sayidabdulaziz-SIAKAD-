@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
<div class="container mt-5">
    <h2>Tambah Dosen</h2>

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. Telp</label>
            <input type="text" name="no_telp" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
