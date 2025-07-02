<!-- resources/views/kerusakan/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kerusakan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kerusakan') }}
        </h2>
    </x-slot>
<body>
    <div class="container mt-5">
        <a href="{{ route('kerusakan.create') }}" class="btn btn-primary mb-3">Tambah Kerusakan</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kerusakan</th>
                    <th>Estimasi Waktu (menit)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($kerusakans as $kerusakan)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kerusakan->nama_kerusakan }}</td>
                        <td>{{ $kerusakan->estimasi_waktu }}</td>
                        <td>
                            <a href="{{ route('kerusakan.edit', $kerusakan->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kerusakan.destroy', $kerusakan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
</x-app-layout>