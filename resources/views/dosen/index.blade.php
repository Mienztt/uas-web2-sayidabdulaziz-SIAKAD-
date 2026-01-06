@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Data Dosen</h2>

    <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">Tambah Dosen</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $dsn)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dsn->nidn }}</td>
                <td>{{ $dsn->nama }}</td>
                <td>{{ $dsn->email }}</td>
                <td>{{ $dsn->no_telp ?? '-' }}</td>
                <td>
                    <a href="{{ route('dosen.show', $dsn->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('dosen.edit', $dsn->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('dosen.destroy', $dsn->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
