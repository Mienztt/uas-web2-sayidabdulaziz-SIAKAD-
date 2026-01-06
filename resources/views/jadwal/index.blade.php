<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Fakultas Komputer</title>
    <!-- Memuat Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-4 md:p-8">

    {{-- 
      Cek Role di Awal. 
      Jika Dosen, 1 prodi = 4 kolom (Waktu, MK, R, Aksi). 
      Jika bukan, 1 prodi = 3 kolom.
    --}}
    @php
        $isDosen = Auth::user()->hasRole('Dosen');
        $colPerProdi = $isDosen ? 4 : 3;
        $totalCols = $colPerProdi * 4; // 4 Prodi
    @endphp

    <!-- Info User Login -->
    <div class="max-w-full mx-auto bg-white shadow-lg p-4 mb-4 border-l-4 border-indigo-500">
        Selamat datang, **{{ Auth::user()->name }}**! Anda login sebagai: 
        @foreach (Auth::user()->getRoleNames() as $role)
            <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full text-xs font-semibold">{{ $role }}</span>
        @endforeach
    </div>

    <!-- Pesan Sukses (setelah Charter berhasil) -->
    @if (session('success'))
        <div class="max-w-full mx-auto bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow-lg rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Kontainer utama untuk 'sheet' -->
    <div class="max-w-full mx-auto bg-white shadow-lg overflow-hidden">

        <div class="pt-4 pb-2">
            <h1 class="text-center text-xl font-bold text-gray-800">JADWAL MATA KULIAH PROGRAM S1 SI & BD, D3 KA</h1>
            <h2 class="text-center text-lg font-bold text-gray-700">SEMESTER GANJIL 2025/2026</h2>
        </div>

        <!-- Kontainer Tabel -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-500 text-sm">
                
                {{-- =================================================================== --}}
                {{-- ============================ HARI SENIN =========================== --}}
                {{-- =================================================================== --}}
                <thead>
                    <tr class="bg-black text-white font-bold">
                        <td colspan="{{ $totalCols / 2 }}" class="p-2 border border-gray-500">Semester 3</td>
                        <td colspan="{{ $totalCols / 2 }}" class="p-2 border border-gray-500 text-right">15 September 2025</td>
                    </tr>
                    <tr class="bg-yellow-300 font-bold text-black text-center">
                        <td colspan="{{ $totalCols }}" class="p-1 border border-gray-500">SENIN</td>
                    </tr>
                    <tr class="font-bold text-white text-center">
                        <td colspan="{{ $colPerProdi }}" class="bg-purple-600 p-1 border border-gray-500">S1 SI</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-blue-600 p-1 border border-gray-500">D3 KA</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / A</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / B</td>
                    </tr>
                    <tr class="font-bold text-center text-xs bg-gray-100">
                        <!-- S1 SI -->
                        <td class="w-24 p-1 border border-gray-500">WAKTU</td>
                        <td class="w-auto p-1 border border-gray-500">S1 SI</td>
                        <td class="w-20 p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="w-20 p-1 border border-gray-500">Aksi</td> @endif
                        <!-- D3 KA -->
                        <td class="w-24 p-1 border border-gray-500">WAKTU</td>
                        <td class="w-auto p-1 border border-gray-500">D3 KA</td>
                        <td class="w-20 p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="w-20 p-1 border border-gray-500">Aksi</td> @endif
                        <!-- S1 BD / A -->
                        <td class="w-24 p-1 border border-gray-500">WAKTU</td>
                        <td class="w-auto p-1 border border-gray-500">S1 BD / A</td>
                        <td class="w-20 p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="w-20 p-1 border border-gray-500">Aksi</td> @endif
                        <!-- S1 BD / B -->
                        <td class="w-24 p-1 border border-gray-500">WAKTU</td>
                        <td class="w-auto p-1 border border-gray-500">S1 BD / B</td>
                        <td class="w-20 p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="w-20 p-1 border border-gray-500">Aksi</td> @endif
                    </tr>
                </thead>
                <tbody class="align-top">
    {{-- Siapkan data Senin --}}
    @php
        $senin = $tabelJadwal->get('Senin', collect());
        $senin_s1_si = $senin->get('S1 SI', collect());
        $senin_d3_ka = $senin->get('D3 KA', collect());
        $senin_s1_bda = $senin->get('S1 BD / A', collect());
        $senin_s1_bdb = $senin->get('S1 BD / B', collect());

        $all_senin_shifts = $shifts->get('Senin', collect());
        $all_s1_si_shifts = $all_senin_shifts->where('prodi', 'S1 SI');
        $all_d3_ka_shifts = $all_senin_shifts->where('prodi', 'D3 KA');
        $all_s1_bda_shifts = $all_senin_shifts->where('prodi', 'S1 BD / A');
        $all_s1_bdb_shifts = $all_senin_shifts->where('prodi', 'S1 BD / B');
    @endphp

    <tr>
        @php $jadwal = $senin_s1_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="bg-yellow-400 p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        @php $jadwal = $senin_d3_ka->firstWhere('shift.jam_mulai', '08:30:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 08.30 - 10.10 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '08:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_s1_bda->firstWhere('shift.jam_mulai', '09:10:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 09.10 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '09:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_s1_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>
    <tr> </tr> <tr>
        @php $jadwal = $senin_s1_si->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_d3_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        @php $jadwal = $senin_s1_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_s1_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.00 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>
    <tr> </tr> <tr class="bg-green-200 text-center font-medium">
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
    </tr>

    <tr>
        @php $jadwal = $senin_s1_si->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.00 - 14.40 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '13:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_d3_ka->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.00 - 14.40 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '13:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        @php $jadwal = $senin_s1_bda->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 12.30 - 13.20 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '12:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_s1_bdb->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.00 - 14.40 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '13:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>
    <tr> </tr>

    <tr>
        @php $jadwal = $senin_s1_si->firstWhere('shift.jam_mulai', '14:51:00'); @endphp
        <td class="p-1 border border-gray-500 h-12" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 14.51 - 16.30 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '14:51:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_d3_ka->firstWhere('shift.jam_mulai', '14:51:00'); @endphp
        <td class="p-1 border border-gray-500 h-12" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 14.51 - 16.30 @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '14:51:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        @php $jadwal = $senin_s1_bda->firstWhere('shift.jam_mulai', '14:51:00'); @endphp
        <td class="p-1 border border-gray-500 h-12" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '14:51:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $senin_s1_bdb->firstWhere('shift.jam_mulai', '14:51:00'); @endphp
        <td class="p-1 border border-gray-500 h-12" rowspan="2">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" rowspan="2">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" rowspan="2">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '14:51:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>
    <tr> </tr>
</tbody>

                {{-- =================================================================== --}}
                {{-- ============================ HARI SELASA ========================== --}}
                {{-- =================================================================== --}}
                <thead>
                    <tr class="bg-yellow-300 font-bold text-black text-center">
                        <td colspan="{{ $totalCols }}" class="p-1 border border-gray-500">SELASA</td>
                    </tr>
                    <tr class="font-bold text-white text-center">
                        <td colspan="{{ $colPerProdi }}" class="bg-purple-600 p-1 border border-gray-500">S1 SI</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-blue-600 p-1 border border-gray-500">D3 KA</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / A</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / B</td>
                    </tr>
                    <tr class="font-bold text-center text-xs bg-gray-100">
                        <!-- S1 SI -->
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 SI</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <!-- D3 KA -->
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">D3 KA</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <!-- S1 BD / A -->
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / A</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <!-- S1 BD / B -->
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / B</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                    </tr>
                </thead>
                <tbody class="align-top">
    {{-- Siapkan data untuk hari Selasa --}}
    @php
        $selasa = $tabelJadwal->get('Selasa', collect());
        $selasa_s1_si = $selasa->get('S1 SI', collect());
        $selasa_d3_ka = $selasa->get('D3 KA', collect());
        $selasa_s1_bda = $selasa->get('S1 BD / A', collect());
        $selasa_s1_bdb = $selasa->get('S1 BD / B', collect());

        $all_selasa_shifts = $shifts->get('Selasa', collect());
        $all_s1_si_shifts = $all_selasa_shifts->where('prodi', 'S1 SI');
        $all_d3_ka_shifts = $all_selasa_shifts->where('prodi', 'D3 KA');
        $all_s1_bda_shifts = $all_selasa_shifts->where('prodi', 'S1 BD / A');
        $all_s1_bdb_shifts = $all_selasa_shifts->where('prodi', 'S1 BD / B');
        
        $s1_bda_sore = $selasa_s1_bda->firstWhere('shift.jam_mulai', '13:00:00');
    @endphp

    <tr>
        @php $jadwal = $selasa_s1_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_d3_ka->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_s1_bda->firstWhere('shift.jam_mulai', '08:20:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 08.20 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '08:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <tr>
        @php $jadwal = $selasa_s1_si->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_d3_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_s1_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <tr class="bg-green-200 text-center font-medium">
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
    </tr>

    <tr>
        @php $jadwal = $selasa_s1_si->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 12.30 - 13.20 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '12:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_d3_ka->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.00-13.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '13:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $s1_bda_sore; @endphp
        <td class="p-1 border border-gray-500" {{ $jadwal ? 'rowspan=2' : '' }}>@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.00 - 15.30 @endif</td>
        <td class="p-1 border border-gray-500" {{ $jadwal ? 'rowspan=2' : '' }}>@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500" {{ $jadwal ? 'rowspan=2' : '' }}>{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle" {{ $jadwal ? 'rowspan=2' : '' }}>
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '13:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
        <td class="p-1 border border-gray-500 bg-yellow-300">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 12.30 - 13.20 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '12:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <tr>
        @php $jadwal = $selasa_s1_si->firstWhere('shift.jam_mulai', '13:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.30-15.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '13:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @php $jadwal = $selasa_d3_ka->firstWhere('shift.jam_mulai', '14:00:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 14.00-15.30 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class.p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '14:00:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        @if(!$s1_bda_sore)
            @php $jadwal = $selasa_s1_bda->firstWhere('shift.jam_mulai', '15:30:00'); @endphp
            <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 15.30 - 17.10 @endif</td>
            <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
            <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
            @if($isDosen)
            <td class="p-1 border border-gray-500 text-center align-middle">
                @if($jadwal)
                    <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
                @else
                    @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '15:30:00'); @endphp
                    @if($shift_kosong)
                        <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                    @endif
                @endif
            </td>
            @endif
        @endif

        @php $jadwal = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '13:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 13.30 - 15.20 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '13:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <tr>
        <td class="p-1 border border-gray-500 h-6"></td><td class="p-1 border border-gray-500"></td><td class="p-1 border border-gray-500"></td>
        @if($isDosen)<td class="p-1 border border-gray-500"></td>@endif
        
        <td class="p-1 border border-gray-500"></td><td class="p-1 border border-gray-500"></td><td class="p-1 border border-gray-500"></td>
        @if($isDosen)<td class="p-1 border border-gray-500"></td>@endif
        
        @if(!$s1_bda_sore)
            <td class="p-1 border border-gray-500">15.30-17.10</td> <td class="p-1 border border-gray-500"></td> <td class="p-1 border border-gray-500"></td>
            @if($isDosen)<td class="p-1 border border-gray-500"></td>@endif
        @else
            <td class="p-1 border border-gray-500 h-6"></td> <td class="p-1 border border-gray-500"></td> <td class="p-1 border border-gray-500"></td>
            @if($isDosen)<td class="p-1 border border-gray-500"></td>@endif
        @endif
        
        <td class="p-1 border border-gray-500"></td><td class="p-1 border border-gray-500"></td><td class="p-1 border border-gray-500"></td>
        @if($isDosen)<td class="p-1 border border-gray-500"></td>@endif
    </tr>
</tbody>

                {{-- =================================================================== --}}
                {{-- ============================ HARI RABU ============================ --}}
                {{-- =================================================================== --}}
                
                <!-- (Terapkan logika $isDosen, $colPerProdi, dan $totalCols yang sama untuk <thead> hari Rabu) -->
                <thead>
                    <tr class="bg-yellow-300 font-bold text-black text-center">
                        <td colspan="{{ $totalCols }}" class="p-1 border border-gray-500">RABU</td>
                    </tr>
                    <!-- (Header Prodi & Sub-header + Aksi) -->
                    <tr class="font-bold text-white text-center">
                        <td colspan="{{ $colPerProdi }}" class="bg-purple-600 p-1 border border-gray-500">S1 SI</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-blue-600 p-1 border border-gray-500">D3 KA</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / A</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / B</td>
                    </tr>
                    <tr class="font-bold text-center text-xs bg-gray-100">
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 SI</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">D3 KA</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / A</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / B</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                    </tr>
                </thead>
                <tbody class="align-top">
    {{-- Siapkan data untuk hari Rabu --}}
    @php
        $rabu = $tabelJadwal->get('Rabu', collect());
        $rabu_s1_si = $rabu->get('S1 SI', collect());
        $rabu_d3_ka = $rabu->get('D3 KA', collect());
        $rabu_s1_bda = $rabu->get('S1 BD / A', collect());
        $rabu_s1_bdb = $rabu->get('S1 BD / B', collect());

        $all_rabu_shifts = $shifts->get('Rabu', collect());
        $all_s1_si_shifts = $all_rabu_shifts->where('prodi', 'S1 SI');
        $all_d3_ka_shifts = $all_rabu_shifts->where('prodi', 'D3 KA');
        $all_s1_bda_shifts = $all_rabu_shifts->where('prodi', 'S1 BD / A');
        $all_s1_bdb_shifts = $all_rabu_shifts->where('prodi', 'S1 BD / B');
    @endphp

    <!-- Baris 1: Blok Pagi (07.30) -->
    <tr>
        <!-- S1 SI (Baris 1) -->
        @php $jadwal = $rabu_s1_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 09.10 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        <!-- D3 KA (Baris 1) - TANPA ROWSPAN -->
        @php $jadwal = $rabu_d3_ka->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500 bg-yellow-300">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / A (Baris 1) - TANPA ROWSPAN -->
        @php $jadwal = $rabu_s1_bda->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500 bg-yellow-300">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / B (Baris 1) - TANPA ROWSPAN -->
        @php $jadwal = $rabu_s1_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="p-1 border border-gray-500 bg-yellow-300">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 07.30 - 10.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '07:30:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <!-- Baris 2: Blok Pagi (09.20) - RENDER SEMUA KOLOM -->
    <tr>
        <!-- S1 SI (Baris 2) -->
        @php $jadwal = $rabu_s1_si->firstWhere('shift.jam_mulai', '09:20:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 09.20-10.10 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '09:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        <!-- D3 KA (Baris 2) - KOSONG -->
        @php $jadwal = $rabu_d3_ka->firstWhere('shift.jam_mulai', '09:20:00'); @endphp <!-- (Mencari shift yg tidak ada) -->
        <td class="p-1 border border-gray-500"></td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '09:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / A (Baris 2) - KOSONG -->
        @php $jadwal = $rabu_s1_bda->firstWhere('shift.jam_mulai', '09:20:00'); @endphp
        <td class="p-1 border border-gray-500"></td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '09:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / B (Baris 2) - KOSONG -->
        @php $jadwal = $rabu_s1_bdb->firstWhere('shift.jam_mulai', '09:20:00'); @endphp
        <td class="p-1 border border-gray-500"></td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '09:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>

    <!-- Baris 3: Blok Siang (10.10) -->
    <tr>
        <!-- S1 SI -->
        @php $jadwal = $rabu_s1_si->firstWhere('shift.jam_mulai', '10:20:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.20 - 12.00 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_si_shifts->firstWhere('jam_mulai', '10:20:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
        
        <!-- D3 KA -->
        @php $jadwal = $rabu_d3_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_d3_ka_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / A -->
        @php $jadwal = $rabu_s1_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bda_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif

        <!-- S1 BD / B -->
        @php $jadwal = $rabu_s1_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="p-1 border border-gray-500 bg-yellow-300">@if($jadwal) {{ \Carbon\Carbon::parse($jadwal->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->shift->jam_selesai)->format('H:i') }} @else 10.10 - 11.50 @endif</td>
        <td class="p-1 border border-gray-500">@if($jadwal) {{ $jadwal->mk->nama_mk }}<br>{{ $jadwal->dosen->nama_dosen }} @endif</td>
        <td class="p-1 border border-gray-500">{{ $jadwal->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen)
        <td class="p-1 border border-gray-500 text-center align-middle">
            @if($jadwal)
                <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded mb-1 w-full">Barter</button>
                <button class="bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-1 px-2 rounded w-full">Pindah</button>
            @else
                @php $shift_kosong = $all_s1_bdb_shifts->firstWhere('jam_mulai', '10:10:00'); @endphp
                @if($shift_kosong)
                    <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">Charter</a>
                @endif
            @endif
        </td>
        @endif
    </tr>
    
    <!-- Baris 4: Shalat Dzuhur (Statis) -->
    <tr class="bg-green-200 text-center font-medium">
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
        <td class="p-1 border border-gray-500">12.00 - 12.30</td>
        <td class="p-1 border border-gray-500" colspan="{{ $isDosen ? 3 : 2 }}">Shalat Dzuhur</td>
    </tr>
</tbody>
              

                {{-- =================================================================== --}}
                {{-- ============================ HARI KAMIS =========================== --}}
                {{-- =================================================================== --}}
                
                <!-- (Terapkan logika $isDosen, $colPerProdi, dan $totalCols yang sama untuk <thead> hari Kamis) -->
                <thead>
                    <tr class="bg-yellow-300 font-bold text-black text-center">
                        <td colspan="{{ $totalCols }}" class="p-1 border border-gray-500">KAMIS</td>
                    </tr>
                    <!-- (Header Prodi & Sub-header + Aksi) -->
                    <tr class="font-bold text-white text-center">
                        <td colspan="{{ $colPerProdi }}" class="bg-purple-600 p-1 border border-gray-500">S1 SI</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-blue-600 p-1 border border-gray-500">D3 KA</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / A</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / B</td>
                    </tr>
                    <tr class="font-bold text-center text-xs bg-gray-100">
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 SI</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">D3 KA</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / A</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / B</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                    </tr>
                </thead>
                <!-- (Terapkan logika @if($isDosen) ... @endif yang sama untuk <tbody> hari Kamis) -->
                <tbody class="align-top">
                     <!-- ... (Logika <tbody> Kamis dengan @if($isDosen) ... @endif) ... -->
                </tbody>

                {{-- =================================================================== --}}
                {{-- ============================ HARI JUMAT =========================== --}}
                {{-- =================================================================== --}}
                
                <!-- (Terapkan logika $isDosen, $colPerProdi, dan $totalCols yang sama untuk <thead> hari Jumat) -->
                <thead>
                    <tr class="bg-yellow-300 font-bold text-black text-center">
                        <td colspan="{{ $totalCols }}" class="p-1 border border-gray-500">JUMAT</td>
                    </tr>
                    <!-- (Header Prodi & Sub-header + Aksi) -->
                    <tr class="font-bold text-white text-center">
                        <td colspan="{{ $colPerProdi }}" class="bg-purple-600 p-1 border border-gray-500">S1 SI</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-blue-600 p-1 border border-gray-500">D3 KA</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / A</td>
                        <td colspan="{{ $colPerProdi }}" class="bg-red-600 p-1 border border-gray-500">S1 BD / B</td>
                    </tr>
                    <tr class="font-bold text-center text-xs bg-gray-100">
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 SI</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">D3 KA</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / A</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                        <td class="p-1 border border-gray-500">WAKTU</td>
                        <td class="p-1 border border-gray-500">S1 BD / B</td>
                        <td class="p-1 border border-gray-500">R</td>
                        @if($isDosen) <td class="p-1 border border-gray-500">Aksi</td> @endif
                    </tr>
                </thead>
                <!-- (Terapkan logika @if($isDosen) ... @endif yang sama untuk <tbody> hari Jumat) -->
                <tbody class="align-top">
                     <!-- ... (Logika <tbody> Jumat dengan @if($isDosen) ... @endif) ... -->
                </tbody>
            </table>
        </div>

        <!-- Bagian Bawah (Tab Bar) -->
        <div class="flex items-center space-x-1 p-1 bg-gray-100 border-t border-gray-300">
            <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>R1</span></button>
            <button class="px-3 py-1 text-sm font-medium text-blue-700 bg-white border-b-4 border-blue-600">R3</button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>R5</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>R7</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>NR1</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>NR3</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>NR5</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>NR7</span></button>
            <button class="flex items-center px-2 py-1 text-sm text-gray-700 hover:bg-gray-200 rounded"><span>RUANG</span></button>
        </div>

    </div> 
</body>
</html>