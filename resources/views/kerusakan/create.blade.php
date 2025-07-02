<!-- resources/views/kerusakan/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kerusakan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-2">
        <h1>Tambah Kerusakan</h1>
        <form action="{{ route('kerusakan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kerusakan">Nama Kerusakan</label>
                <input type="text" class="form-control" id="nama_kerusakan" name="nama_kerusakan" required>
            </div>
            <div class="form-group">
                <label for="estimasi_waktu">Estimasi Waktu (menit)</label>
                <input type="number" class="form-control" id="estimasi_waktu" name="estimasi_waktu" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kerusakan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>