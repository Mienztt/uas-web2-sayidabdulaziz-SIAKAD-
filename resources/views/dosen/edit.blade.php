@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="container mt-5">
    <h2>Edit Data Dosen</h2>

    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn) }}" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $dosen->nama) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $dosen->email) }}" required>
        </div>
        <div class="mb-3">
            <label>No. Telp</label>
            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $dosen->no_telp) }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
