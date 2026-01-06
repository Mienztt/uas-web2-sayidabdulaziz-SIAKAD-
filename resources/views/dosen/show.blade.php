@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm" style="max-width: 400px;">
        <h4>{{ $dosen->nama }}</h4>
        <p><strong>NIDN:</strong> {{ $dosen->nidn }}</p>
        <p><strong>Email:</strong> {{ $dosen->email }}</p>
        <p><strong>No. Telp:</strong> {{ $dosen->no_telp ?? '-' }}</p>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
