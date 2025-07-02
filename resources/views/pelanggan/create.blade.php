<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Antrian Bengkel Motor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Antrian Bengkel Motor</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
        @endphp

        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf

            {{-- Nama Pemilik (Otomatis dari User Login) --}}
            <div class="form-group">
                <label for="nama_pemilik">Nama Pemilik</label>
                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik"
                       value="{{ $user->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="nomor_motor">Nomor Motor</label>
                <input type="text" class="form-control" id="nomor_motor" name="nomor_motor" required>
            </div>

            <div class="form-group">
                <label for="type_motor">Type Motor</label>
                <input type="text" class="form-control" id="type_motor" name="type_motor" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Antrian</button>
            <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>