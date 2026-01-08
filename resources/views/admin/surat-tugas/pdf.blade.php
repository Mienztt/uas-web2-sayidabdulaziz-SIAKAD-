<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Tugas - {{ $suratTugas->dosen->name }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; }
        .container { width: 90%; margin: 0 auto; }
        .header-table { width: 100%; border-bottom: 2px solid black; }
        .header-table td { vertical-align: top; }
        .logo { width: 80px; } /* Sesuaikan ukuran logo jika perlu */
        .kop-tengah { text-align: center; }
        .kop-tengah h1 { font-size: 16pt; margin: 0; }
        .kop-tengah h2 { font-size: 14pt; margin: 0; font-weight: normal; }
        .kop-tengah p { font-size: 11pt; margin: 0; }
        .judul-surat { text-align: center; margin-top: 30px; }
        .judul-surat h3 { margin: 0; text-decoration: underline; font-size: 14pt; }
        .judul-surat p { margin: 0; }
        .konten { margin-top: 30px; }
        .tabel-dosen, .tabel-matkul { border-collapse: collapse; margin-top: 15px; width: 100%; }
        .tabel-dosen td { vertical-align: top; padding: 2px; }
        .tabel-matkul th, .tabel-matkul td { border: 1px solid black; padding: 5px; text-align: center; }
        .tabel-matkul th { background-color: #f2f2f2; }
        .tabel-matkul td.text-left { text-align: left; }
        .tabel-matkul .total-row td { font-weight: bold; background-color: #f2f2f2; }
        .paragraf { text-align: justify; margin-top: 15px; }
        .tanda-tangan { width: 100%; margin-top: 40px; }
        .ttd-kanan { width: 40%; float: right; text-align: left; }
        .ttd-kanan .jabatan { margin-bottom: 80px; } /* Memberi ruang untuk TTD */
        .ttd-kanan .nama { font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td style="width: 15%;">
                    </td>
                <td style="width: 85%;" class="kop-tengah">
                    <h1>UNIVERSITAS MA'SOEM</h1> <h2>FAKULTAS KOMPUTER</h2>
                    <p>SK. No.: 114/KPT/1/2019 Terakreditasi BAN-PT</p> <p>Kampus: Jl. Raya Cipacing No. 22 Jatinangor - Sumedang 45363</p> <p>Telp. (022) 7798340 Fax. (022) 7798243</p> <p>email: info@masoemuniversity.ac.id Web Site: www.masoemuniversity.ac.id</p> </td>
            </tr>
        </table>

        <div class="judul-surat">
            <h3>SURAT TUGAS PENGAJARAN</h3> <p>Nomor: {{ $nomorSurat }}</p> </div>

        <div class="konten">
            <p>Yang bertanda tangan di bawah ini Dekan Fakultas Komputer, menugaskan kepada:</p> <table class="tabel-dosen">
                <tr>
                    <td style="width: 15%;">Nama</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 83%; font-weight: bold;">{{ $suratTugas->dosen->name }}</td> </tr>
                <tr>
                    <td>NIDN</td>
                    <td>:</td>
                    <td>-</td> </tr>
            </table>

            <p style="margin-top: 15px;">Untuk mengampu matakuliah sebagai berikut:</p> <table class="tabel-matkul">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Matakuliah</th>
                        <th>SKS</th>
                        <th>Program</th>
                        <th>SMT</th>
                        <th>Kelas</th>
                        <th>Jml. Kelas</th>
                        <th>Jml. SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalSks = 0; @endphp
                    @foreach($detailMatakuliah as $detail)
                    <tr>
                        <td>{{ $detail['no'] }}.</td>
                        <td class="text-left">{{ $detail['nama'] }}</td>
                        <td>{{ $detail['sks'] }}</td>
                        <td>{{ $detail['program'] }}</td>
                        <td>{{ $detail['smt'] }}</td>
                        <td>{{ $detail['kelas'] }}</td>
                        <td>{{ $detail['jml_kelas'] }}</td>
                        <td>{{ $detail['jml_sks'] }}</td>
                    </tr>
                    @php $totalSks += $detail['jml_sks']; @endphp
                    @endforeach
                    <tr class="total-row">
                        <td colspan="2">Total SKS</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $totalSks }}</td>
                    </tr>
                </tbody>
            </table>

            <p class="paragraf">
                Perlu kami sampaikan bahwa perkuliahan semester Ganjil tahun akademik 2025/2026 insha Allah akan dimulai tanggal 15 September 2025, untuk itu kami mohon Bapak dapat mempersiapkan Rencana Pembelajaran Semester (RPS) dan Bahan Ajar untuk matakuliah di atas dan menyampaikannya ke Fakultas Komputer Universitas Ma'soem paling lambat diminggu pertama perkuliahan. </p>
            <p class="paragraf">Atas perhatiannya kami ucapkan terimakasih.</p> <table class="tanda-tangan">
                <tr>
                    <td>
                        <div class="ttd-kanan">
                            Jatinangor, {{ $tanggalSurat }}<br> <span class="jabatan">Dekan Fakultas Komputer,</span> <br>

                            <span class="nama">Haekal Pirous, S.T., M.A.B</span> </div>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</body>
</html>