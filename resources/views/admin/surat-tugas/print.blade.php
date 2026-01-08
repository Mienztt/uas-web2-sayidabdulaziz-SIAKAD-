<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Tugas Pengajaran - {{ $surat->dosen->nama_dosen }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding: 30px; line-height: 1.5; color: #000; }
        .kop-surat { text-align: center; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 20px; position: relative; }
        .kop-surat h1 { font-size: 22px; margin: 0; font-weight: 900; letter-spacing: 1px; }
        .kop-surat p { margin: 2px 0; font-size: 10px; }
        
        .judul-surat { text-align: center; margin-bottom: 25px; }
        .judul-surat h2 { font-size: 16px; text-decoration: underline; margin: 0; }
        .judul-surat p { margin: 5px 0; font-weight: bold; }

        .penerima { margin-bottom: 20px; }
        .table-data { margin-left: 20px; margin-bottom: 15px; }

        .table-jadwal { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-jadwal th, .table-jadwal td { border: 1px solid black; padding: 5px; text-align: center; font-size: 11px; }
        .table-jadwal th { background-color: #f2f2f2; }

        .penutup { margin-top: 20px; text-align: justify; }
        .tanda-tangan { margin-top: 40px; float: right; width: 250px; text-align: center; }
        
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <h1>UNIVERSITAS MA'SOEM</h1> <p>SK. No.: 114/KPT/I/2019 Terakreditasi BAN-PT</p> <p>Kampus: Jl. Raya Cipacing No. 22 Jatinangor - Sumedang 45363 Telp. (022) 7798340</p> <p>email: info@masoemuniversity.ac.id Web Site: www.masoemuniversity.ac.id</p> </div>

    <div class="judul-surat">
        <h2>SURAT TUGAS PENGAJARAN</h2> <p>Nomor: {{ $surat->nomor_surat }}</p> </div>

    <div class="penerima">
        <p>Yang bertanda tangan di bawah ini Dekan Fakultas Komputer, menugaskan kepada:</p> <table class="table-data">
            <tr><td width="100">Nama</td><td>: {{ $surat->dosen->nama_dosen }}</td></tr> <tr><td>NIDN</td><td>: {{ $surat->dosen->nidn }}</td></tr> </table>
        <p>Untuk mengampu matakuliah sebagai berikut:</p> </div>

    <table class="table-jadwal">
        <thead>
            <tr>
                <th>No</th>
                <th>Matakuliah</th>
                <th>SKS</th>
                <th>Program</th>
                <th>SMT</th>
                <th>Jml. Kelas</th>
                <th>Jml. SKS</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSks = 0; @endphp
            @foreach($jadwalDosen as $mkId => $items)
                @php 
                    $mk = $items->first()->mk;
                    $jmlKelas = $items->count();
                    $subTotalSks = $mk->sks * $jmlKelas;
                    $totalSks += $subTotalSks;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td style="text-align: left;">{{ $mk->nama_mk }}</td> <td>{{ $mk->sks }}</td>
                    <td>S1 SI</td> <td>{{ $mk->semester }}</td>
                    <td>{{ $jmlKelas }}</td>
                    <td>{{ $subTotalSks }}</td> </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right; font-weight: bold; padding-right: 15px;">Total SKS</td>
                <td style="font-weight: bold;">{{ $totalSks }}</td> </tr>
        </tbody>
    </table>

 <div class="penutup">
    @php
        // Pecah teks semester_aktif
        $parts = explode(' ', $surat->semester_aktif);
        // Ambil bagian pertama sebagai tahun, bagian kedua sebagai semester (jika ada)
        $tahun_akademik = $parts[0] ?? $surat->semester_aktif;
        $nama_semester = $parts[1] ?? ''; 
    @endphp

    <p>Perlu kami sampaikan bahwa perkuliahan semester {{ $nama_semester }} tahun akademik {{ $tahun_akademik }} 
    insha Allah akan dimulai tanggal 15 September 2025, untuk itu kami mohon Bapak dapat mempersiapkan Rencana Pembelajaran Semester (RPS) 
    dan Bahan Ajar untuk matakuliah di atas dan menyampaikannya ke Fakultas Komputer Universitas Ma'soem paling lambat diminggu pertama perkuliahan.</p>
    
    <p>Atas perhatiannya kami ucapkan terimakasih.</p>
</div>

    <div class="tanda-tangan">
        <p>Jatinangor, {{ \Carbon\Carbon::parse($surat->tanggal_terbit)->translatedFormat('d F Y') }}</p> <p>Dekan Fakultas Komputer</p> <br><br><br><br>
        <p><b>Haekal Pirous, S.T., M.A.B</b></p> </div>

</body>
</html>