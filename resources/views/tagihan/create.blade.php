<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tagihan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Buat Tagihan untuk {{ $antrian->nama_pemilik }}</h1>

        <form action="{{ route('tagihan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">

            <div class="form-group">
                <label for="jumlah">Jumlah Tagihan</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>

            <button type="submit" class="btn btn-success">Kirim Tagihan</button>
            <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
