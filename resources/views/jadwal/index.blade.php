<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-10 font-sans">
        <div class="max-w-[98%] mx-auto space-y-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
                <div>
                    <a href="{{ route('dashboard') }}" class="group inline-flex items-center space-x-2 bg-white border border-gray-200 text-gray-600 px-5 py-2.5 rounded-xl shadow-sm hover:border-indigo-500 hover:text-indigo-600 transition-all">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span class="font-bold text-sm">Kembali ke Dashboard</span>
                    </a>
                </div>
                <div class="text-right">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Jadwal Perkuliahan</h1>
                    <div class="flex items-center justify-end space-x-2 text-sm text-gray-500 font-medium mt-1">
                        <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded text-xs font-bold uppercase">Ganjil 2025/2026</span>
                        <span>&bull;</span>
                        <span>Fakultas Komputer</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.1)] border border-gray-100 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full -mr-20 -mt-20 blur-3xl opacity-50"></div>
                
                <div class="flex items-center space-x-5 relative z-10">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-indigo-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Login Session</p>
                        <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach (Auth::user()->getRoleNames() as $role)
                                <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wide">{{ $role }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 p-4 rounded-2xl shadow-sm flex items-center justify-between animate-fade-in-down">
                    <div class="flex items-center space-x-3">
                        <div class="bg-emerald-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-700">&times;</button>
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                
                @php
                    $isDosen = Auth::user()->hasRole('Dosen');
                    $colPerProdi = $isDosen ? 4 : 3;
                    $totalCols = $colPerProdi * 4; 
                @endphp

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        
                        {{-- ================= HEADER UTAMA ================= --}}
                        <thead>
                            <tr class="bg-slate-900 text-white">
                                <td colspan="{{ $totalCols / 2 }}" class="p-5 text-left pl-8 font-bold text-sm uppercase tracking-widest text-slate-400">Semester 3</td>
                                <td colspan="{{ $totalCols / 2 }}" class="p-5 text-right pr-8 font-mono text-sm font-bold text-slate-400">15 September 2025</td>
                            </tr>
                        </thead>

                        {{-- ================= HARI SENIN ================= --}}
                        <thead>
                            <tr class="bg-amber-400 text-slate-900">
                                <td colspan="{{ $totalCols }}" class="py-3 text-center font-black text-lg tracking-[0.25em] shadow-sm">SENIN</td>
                            </tr>
                            <tr class="text-white text-xs font-bold uppercase tracking-wider text-center">
                                <td colspan="{{ $colPerProdi }}" class="bg-indigo-600 py-3 border-r border-white/10">S1 Sistem Informasi</td>
                                <td colspan="{{ $colPerProdi }}" class="bg-sky-600 py-3 border-r border-white/10">D3 Komp. Akuntansi</td>
                                <td colspan="{{ $colPerProdi }}" class="bg-rose-600 py-3 border-r border-white/10">S1 Bisnis Digital (A)</td>
                                <td colspan="{{ $colPerProdi }}" class="bg-rose-700 py-3">S1 Bisnis Digital (B)</td>
                            </tr>
                            <tr class="bg-slate-50 text-slate-500 text-[10px] font-bold uppercase tracking-widest text-center border-b border-slate-200">
                                @foreach(['S1 SI', 'D3 KA', 'S1 BD / A', 'S1 BD / B'] as $prodi)
                                    <td class="py-3 w-24 border-r border-slate-200">Jam</td>
                                    <td class="py-3 border-r border-slate-200">Mata Kuliah / Dosen</td>
                                    <td class="py-3 w-16 border-r border-slate-200">R</td>
                                    @if($isDosen) <td class="py-3 w-28 border-r border-slate-200 bg-slate-100">Aksi</td> @endif
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="text-sm align-top divide-y divide-slate-100">
                            @php
                                $senin = $tabelJadwal->get('Senin', collect());
                                $senin_s1_si = $senin->get('S1 SI', collect());
                                $senin_d3_ka = $senin->get('D3 KA', collect());
                                $senin_s1_bda = $senin->get('S1 BD / A', collect());
                                $senin_s1_bdb = $senin->get('S1 BD / B', collect());

                                $all_senin = $shifts->get('Senin', collect());
                                $shift_si = $all_senin->where('prodi', 'S1 SI');
                                $shift_ka = $all_senin->where('prodi', 'D3 KA');
                                $shift_bda = $all_senin->where('prodi', 'S1 BD / A');
                                $shift_bdb = $all_senin->where('prodi', 'S1 BD / B');
                            @endphp

                            <tr class="hover:bg-slate-50 transition-colors">
                                @php $j = $senin_s1_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_si, 'jam' => '07:30:00'])</td> @endif

                                @php $j = $senin_d3_ka->firstWhere('shift.jam_mulai', '08:30:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 08.30<br>-<br>10.10 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_ka, 'jam' => '08:30:00'])</td> @endif

                                @php $j = $senin_s1_bda->firstWhere('shift.jam_mulai', '09:10:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 09.10<br>-<br>10.00 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bda, 'jam' => '09:10:00'])</td> @endif

                                @php $j = $senin_s1_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bdb, 'jam' => '07:30:00'])</td> @endif
                            </tr>
                            <tr></tr> <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
                                @php $j = $senin_s1_si->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_si, 'jam' => '10:10:00'])</td> @endif

                                @php $j = $senin_d3_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_ka, 'jam' => '10:10:00'])</td> @endif

                                @php $j = $senin_s1_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bda, 'jam' => '10:10:00'])</td> @endif

                                @php $j = $senin_s1_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.00 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bdb, 'jam' => '10:10:00'])</td> @endif
                            </tr>
                            <tr></tr>

                            <tr class="bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase tracking-widest text-center border-y border-emerald-100">
                                <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
                                <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
                                <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
                                <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
                                @php $j = $senin_s1_si->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 13.00<br>-<br>14.40 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_si, 'jam' => '13:00:00'])</td> @endif

                                @php $j = $senin_d3_ka->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 13.00<br>-<br>14.40 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_ka, 'jam' => '13:00:00'])</td> @endif

                                @php $j = $senin_s1_bda->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 12.30<br>-<br>13.20 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bda, 'jam' => '12:30:00'])</td> @endif

                                @php $j = $senin_s1_bdb->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
                                <td class="cell-waktu" rowspan="2">@if($j) {{ $j->jam_text }} @else 13.00<br>-<br>14.40 @endif</td>
                                <td class="cell-mk" rowspan="2">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
                                <td class="cell-ruang" rowspan="2">{{ $j->ruang->nama_ruang ?? '' }}</td>
                                @if($isDosen) <td class="cell-aksi" rowspan="2">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $shift_bdb, 'jam' => '13:00:00'])</td> @endif
                            </tr>
                            <tr></tr>
                        </tbody>

                        {{-- ================= HARI SELASA ================= --}}
                        {{-- ================= HARI SELASA ================= --}}
<thead>
    <tr><td colspan="{{ $totalCols }}" class="h-8 bg-transparent border-none"></td></tr>
    
    <tr class="bg-amber-400 text-slate-900">
        <td colspan="{{ $totalCols }}" class="py-3 text-center font-black text-lg tracking-[0.25em] shadow-sm rounded-t-xl">SELASA</td>
    </tr>
</thead>
<tbody class="text-sm align-top divide-y divide-slate-100 bg-white border border-gray-100">
    @php
        $selasa = $tabelJadwal->get('Selasa', collect());
        $selasa_s1_si = $selasa->get('S1 SI', collect());
        $selasa_d3_ka = $selasa->get('D3 KA', collect());
        $selasa_s1_bda = $selasa->get('S1 BD / A', collect());
        $selasa_s1_bdb = $selasa->get('S1 BD / B', collect());

        $all_selasa = $shifts->get('Selasa', collect());
        $sh_si = $all_selasa->where('prodi', 'S1 SI');
        $sh_ka = $all_selasa->where('prodi', 'D3 KA');
        $sh_bda = $all_selasa->where('prodi', 'S1 BD / A');
        $sh_bdb = $all_selasa->where('prodi', 'S1 BD / B');
        
        // Logika Khusus BD A Sore
        $s1_bda_sore = $selasa_s1_bda->firstWhere('shift.jam_mulai', '13:00:00');
    @endphp

    <tr class="hover:bg-slate-50 transition-colors">
        @php $j = $selasa_s1_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '07:30:00'])</td> @endif

        @php $j = $selasa_d3_ka->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '07:30:00'])</td> @endif

        @php $j = $selasa_s1_bda->firstWhere('shift.jam_mulai', '08:20:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 08.20<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bda, 'jam' => '08:20:00'])</td> @endif

        @php $j = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '07:30:00'])</td> @endif
    </tr>

    <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
        @php $j = $selasa_s1_si->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '10:10:00'])</td> @endif

        @php $j = $selasa_d3_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '10:10:00'])</td> @endif

        @php $j = $selasa_s1_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bda, 'jam' => '10:10:00'])</td> @endif

        @php $j = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '10:10:00'])</td> @endif
    </tr>

    <tr class="bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase tracking-widest text-center border-y border-emerald-100">
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
    </tr>

    <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
        @php $j = $selasa_s1_si->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 12.30<br>-<br>13.20 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '12:30:00'])</td> @endif

        @php $j = $selasa_d3_ka->firstWhere('shift.jam_mulai', '13:00:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 13.00<br>-<br>13.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '13:00:00'])</td> @endif

        @php $j = $s1_bda_sore; @endphp
        <td class="cell-waktu" {{ $j ? 'rowspan=2' : '' }}>@if($j) {{ $j->jam_text }} @else 13.00<br>-<br>15.30 @endif</td>
        <td class="cell-mk" {{ $j ? 'rowspan=2' : '' }}>@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang" {{ $j ? 'rowspan=2' : '' }}>{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi" {{ $j ? 'rowspan=2' : '' }}>@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bda, 'jam' => '13:00:00'])</td> @endif

        @php $j = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '12:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 12.30<br>-<br>13.20 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '12:30:00'])</td> @endif
    </tr>

    <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
        @php $j = $selasa_s1_si->firstWhere('shift.jam_mulai', '13:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 13.30<br>-<br>15.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '13:30:00'])</td> @endif

        @php $j = $selasa_d3_ka->firstWhere('shift.jam_mulai', '14:00:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 14.00<br>-<br>15.30 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '14:00:00'])</td> @endif

        @if(!$s1_bda_sore)
            @php $j = $selasa_s1_bda->firstWhere('shift.jam_mulai', '15:30:00'); @endphp
            <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 15.30-17.10 @endif</td>
            <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b> @endif</td>
            <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
            @if($isDosen) <td class="cell-aksi">...</td> @endif
        @endif

        @php $j = $selasa_s1_bdb->firstWhere('shift.jam_mulai', '13:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 13.30<br>-<br>15.20 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '13:30:00'])</td> @endif
    </tr>
</tbody>
{{-- ================= HARI RABU ================= --}}
<thead>
    <tr><td colspan="{{ $totalCols }}" class="h-8 bg-transparent border-none"></td></tr>
    
    <tr class="bg-amber-400 text-slate-900">
        <td colspan="{{ $totalCols }}" class="py-3 text-center font-black text-lg tracking-[0.25em] shadow-sm rounded-t-xl">RABU</td>
    </tr>
</thead>
<tbody class="text-sm align-top divide-y divide-slate-100 bg-white border border-gray-100">
    @php
        $rabu = $tabelJadwal->get('Rabu', collect());
        $r_si = $rabu->get('S1 SI', collect()); $r_ka = $rabu->get('D3 KA', collect());
        $r_bda = $rabu->get('S1 BD / A', collect()); $r_bdb = $rabu->get('S1 BD / B', collect());

        $all_rabu = $shifts->get('Rabu', collect());
        $sh_si = $all_rabu->where('prodi', 'S1 SI'); $sh_ka = $all_rabu->where('prodi', 'D3 KA');
        $sh_bda = $all_rabu->where('prodi', 'S1 BD / A'); $sh_bdb = $all_rabu->where('prodi', 'S1 BD / B');
    @endphp

    <tr class="hover:bg-slate-50 transition-colors">
        @php $j = $r_si->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>09.10 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '07:30:00'])</td> @endif
        
        @php $j = $r_ka->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '07:30:00'])</td> @endif

        @php $j = $r_bda->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bda, 'jam' => '07:30:00'])</td> @endif

        @php $j = $r_bdb->firstWhere('shift.jam_mulai', '07:30:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 07.30<br>-<br>10.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '07:30:00'])</td> @endif
    </tr>

    <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
        @php $j = $r_si->firstWhere('shift.jam_mulai', '09:20:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 09.20<br>-<br>10.10 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '09:20:00'])</td> @endif
        
        <td class="cell-waktu"></td><td class="cell-mk"></td><td class="cell-ruang"></td>@if($isDosen)<td class="cell-aksi"></td>@endif
        <td class="cell-waktu"></td><td class="cell-mk"></td><td class="cell-ruang"></td>@if($isDosen)<td class="cell-aksi"></td>@endif
        <td class="cell-waktu"></td><td class="cell-mk"></td><td class="cell-ruang"></td>@if($isDosen)<td class="cell-aksi"></td>@endif
    </tr>

    <tr class="hover:bg-slate-50 transition-colors border-t border-slate-100">
        @php $j = $r_si->firstWhere('shift.jam_mulai', '10:20:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.20<br>-<br>12.00 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_si, 'jam' => '10:20:00'])</td> @endif

        @php $j = $r_ka->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_ka, 'jam' => '10:10:00'])</td> @endif

        @php $j = $r_bda->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bda, 'jam' => '10:10:00'])</td> @endif

        @php $j = $r_bdb->firstWhere('shift.jam_mulai', '10:10:00'); @endphp
        <td class="cell-waktu">@if($j) {{ $j->jam_text }} @else 10.10<br>-<br>11.50 @endif</td>
        <td class="cell-mk">@if($j) <b>{{ $j->mk->nama_mk }}</b><br><span class="badge-dosen">{{ $j->dosen->nama_dosen }}</span> @endif</td>
        <td class="cell-ruang">{{ $j->ruang->nama_ruang ?? '' }}</td>
        @if($isDosen) <td class="cell-aksi">@include('jadwal.partials.aksi', ['jadwal' => $j, 'shifts' => $sh_bdb, 'jam' => '10:10:00'])</td> @endif
    </tr>

    <tr class="bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase tracking-widest text-center border-y border-emerald-100">
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
        <td class="py-2">12.00 - 12.30</td><td colspan="{{ $isDosen ? 3 : 2 }}">Istirahat / Shalat</td>
    </tr>
</tbody>
{{-- ================= HARI KAMIS ================= --}}
<thead>
    <tr><td colspan="{{ $totalCols }}" class="h-8 bg-transparent border-none"></td></tr>
    <tr class="bg-amber-400 text-slate-900">
        <td colspan="{{ $totalCols }}" class="py-3 text-center font-black text-lg tracking-[0.25em] shadow-sm rounded-t-xl">KAMIS</td>
    </tr>
</thead>
<tbody class="text-sm align-top divide-y divide-slate-100 bg-white border border-gray-100">
    <tr class="hover:bg-slate-50 transition-colors">
        <td colspan="{{ $totalCols }}" class="p-8 text-center text-gray-400 italic">
            Data jadwal Kamis belum dimuat. Silakan salin logika PHP kamu di sini.
        </td>
    </tr>
</tbody>

{{-- ================= HARI JUMAT ================= --}}
<thead>
    <tr><td colspan="{{ $totalCols }}" class="h-8 bg-transparent border-none"></td></tr>
    <tr class="bg-amber-400 text-slate-900">
        <td colspan="{{ $totalCols }}" class="py-3 text-center font-black text-lg tracking-[0.25em] shadow-sm rounded-t-xl">JUMAT</td>
    </tr>
</thead>
<tbody class="text-sm align-top divide-y divide-slate-100 bg-white border border-gray-100">
    <tr class="hover:bg-slate-50 transition-colors">
        <td colspan="{{ $totalCols }}" class="p-8 text-center text-gray-400 italic">
             Data jadwal Jumat belum dimuat. Silakan salin logika PHP kamu di sini.
        </td>
    </tr>
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cell-waktu { @apply p-3 border-r border-slate-100 text-center font-mono text-xs text-slate-500 bg-slate-50/50; }
        .cell-mk { @apply p-3 border-r border-slate-100 align-middle; }
        .cell-ruang { @apply p-3 border-r border-slate-100 text-center font-bold text-slate-700 bg-slate-50/30; }
        .cell-aksi { @apply p-2 border-r border-slate-100 text-center align-middle bg-slate-50/50; }
        .badge-dosen { @apply text-[10px] text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded border border-indigo-100 mt-1 inline-block; }
    </style>
</x-app-layout>