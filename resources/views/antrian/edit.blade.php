<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Antrian Bengkel Motor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Antrian Bengkel Motor</h1>
        <form action="{{ route('antrian.update', $antrian->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Menambahkan metode PUT untuk update -->
            <div class="form-group">
                <label for="nama_pemilik">Nama Pemilik</label>
                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="{{ $antrian->nama_pemilik }}" required>
            </div>
            <div class="form-group">
                <label for="nomor_motor">Nomor Motor</label>
                <input type="text" class="form-control" id="nomor_motor" name="nomor_motor" value="{{ $antrian->nomor_motor }}" required>
            </div>
            <div class="form-group">
                <label for="type_motor">Tipe Motor</label>
                <input type="text" class="form-control" id="type_motor" name="type_motor" value="{{ $antrian->type_motor }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="draft" {{ $antrian->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="dalam_antrian" {{ $antrian->status == 'dalam_antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>