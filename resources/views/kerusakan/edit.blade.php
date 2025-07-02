<!-- resources/views/kerusakan/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kerusakan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Kerusakan</h1>
        <form action="{{ route('kerusakan.update', $kerusakan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_kerusakan">Nama Kerusakan</label>
                <input type="text" class="form-control" id="nama_kerusakan" name="nama_kerusakan" value="{{ $kerusakan->nama_kerusakan }}" required>
            </div>
            <div class="form-group">
                <label for="estimasi_waktu">Estimasi Waktu (menit)</label>
                <input type="number" class="form-control" id="estimasi_waktu" name="estimasi_waktu" value="{{ $kerusakan->estimasi_waktu }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>