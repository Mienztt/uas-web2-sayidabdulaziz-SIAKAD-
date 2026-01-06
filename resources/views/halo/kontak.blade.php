<!-- resources/views/kontak.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center text-primary mb-4">Hubungi Kami</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <form>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" placeholder="Masukkan nama Anda">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Masukkan email Anda">
                        </div>
                        
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea id="pesan" class="form-control" rows="4" placeholder="Tulis pesan Anda"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p>Email: <strong>admin@laravel12.com</strong></p>
            <p>WhatsApp: <strong>+62 812 3456 7890</strong></p>
        </div>
    </div>
</body>
</html>
