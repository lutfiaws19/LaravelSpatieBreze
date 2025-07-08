<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrian Bengkel Motor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Antrian Bengkel Motor') }}
        </h2>
    </x-slot>
<body>
    <div class="container mt-5">
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Motor</th>
                    <th>status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Nomor Antrian</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
               @php 
                    $no = 1; 
                    $totalEstimasi = 0; // Inisialisasi total estimasi waktu
                @endphp <!-- Inisialisasi variabel nomor -->
                @foreach ($antrians as $antrian)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $antrian->nama_pemilik }}</td>
                        <td>{{ $antrian->nomor_motor }}</td>
                        <td>{{ $antrian->status }}</td>
                        <td>{{ $antrian->created_at }}</td>
                        <td>{{ $antrian->nomor_antrian }}</td>
                        <td><a href="{{ route('penagihan.show', $antrian->id) }}" class="btn btn-success btn-sm">Lihat Pesan Penagihan</a></td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>