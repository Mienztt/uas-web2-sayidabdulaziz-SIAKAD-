<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .input-cari { padding: 10px; width: 300px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <h2>Data Mahasiswa</h2>

    <input type="text" id="keyword" class="input-cari" placeholder="Cari NIM, Nama, atau Prodi...">
    <span id="loading" style="display:none;">Sedang mencari...</span>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody id="wadah-tabel">
            @include('tabel_mhs') </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#keyword').on('keyup', function() {
                var katakunci = $(this).val();

                // Syarat: Lebih dari 2 huruf baru mencari
                if(katakunci.length > 2) {
                    $('#loading').show();
                    
                    $.ajax({
                        url: "{{ route('mhs.cari') }}",
                        type: "GET",
                        data: { keyword: katakunci },
                        success: function(data) {
                            // Ganti isi tbody dengan HTML hasil renderan Controller
                            $('#wadah-tabel').html(data);
                            $('#loading').hide();
                        }
                    });
                } 
                // Opsional: Kalau dihapus sampai kosong, kembalikan data awal (perlu logika tambahan sebenernya, tapi ini basic)
                else if(katakunci.length == 0) {
                     location.reload(); // Reload simple jika kosong
                }
            });
        });
    </script>

</body>
</html>