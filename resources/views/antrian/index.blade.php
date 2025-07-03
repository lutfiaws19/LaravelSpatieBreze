<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrian Bengkel Motor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Tambahkan Font Awesome -->
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Antrian Bengkel Motor') }}
        </h2>
    </x-slot>
<body>
    <div class="container mt-5">
         @if(Auth::user()->hasRole('Admin'))
        <a href="{{ route('antrian.create') }}" class="btn btn-primary mb-3">Tambah Antrian</a>
         @endif

          <!-- Form Pencarian -->
    <form method="GET" action="{{ route('antrian.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="nama_pemilik" class="form-control" placeholder="Cari Nama Pemilik" value="{{ request('nama_pemilik') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="tanggal_masuk" class="form-control" placeholder="Filter Tanggal Masuk" value="{{ request('tanggal_masuk') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th> <!-- Kolom untuk nomor antrian -->
                    <th>Nama Pemilik</th>
                    <th>Nomor Motor</th>
                    <th>Type Motor</th>
                    <th>Model Kerusakan</th>
                    <th>Estimasi Waktu</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Nomor Antrian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $no = 1; 
                    $totalEstimasi = 0; // Inisialisasi total estimasi waktu
                @endphp <!-- Inisialisasi variabel nomor -->
                @foreach ($antrians as $antrian)
                    <tr>
                        <td>{{ $no++ }}</td> <!-- Tampilkan nomor antrian dan increment -->
                        <td>{{ $antrian->nama_pemilik }}</td>
                        <td>{{ $antrian->nomor_motor }}</td>
                        <td>{{ $antrian->type_motor }}</td>
                        <td>{{ $antrian->Kerusakan->nama_kerusakan }}</td>
                        <td>
                            @php
                                $estimasiWaktu = $antrian->Kerusakan->estimasi_waktu; // Ambil estimasi waktu
                                $totalEstimasi += $estimasiWaktu; // Tambahkan ke total estimasi
                            @endphp
                            {{ $estimasiWaktu }} menit
                        </td>
                        <td>
                            @if ($antrian->status == 'dalam_antrian')
                                <span class="badge badge-warning">Dalam Antrian</span>
                            @elseif ($antrian->status == 'draft')
                                <span class="badge badge-secondary">Draft</span>
                            @elseif ($antrian->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $antrian->tanggal_masuk }}</td>
                        <td>{{ $antrian->nomor_antrian }}</td>
                        <td>
                            <a href="{{ route('antrian.edit', $antrian->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('antrian.destroy', $antrian->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus antrian ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                            <form action="{{ route('antrian.toHistory', $antrian->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Pindahkan antrian ini ke riwayat?')">Selesaikan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Menampilkan total estimasi waktu -->
        <div class="alert alert-info">
            <strong>Total Estimasi Waktu:</strong> <span id="total_estimasi">{{ $totalEstimasi }}</span> menit
            <strong>Countdown:</strong> <span id="countdown_timer"></span>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const estimasiWaktuInput = document.getElementById('estimasi_waktu');


            // Set estimasi waktu berdasarkan kerusakan yang sudah dipilih saat load
            const selectedOption = kerusakanSelect.options[kerusakanSelect.selectedIndex];
            estimasiWaktuInput.value = selectedOption.getAttribute('data-estimasi');



            kerusakanSelect.addEventListener('change', function() {
                const selectedOption = kerusakanSelect.options[kerusakanSelect.selectedIndex];
                const estimasiWaktu = selectedOption.getAttribute('data-estimasi');
                estimasiWaktuInput.value = estimasiWaktu;
            });

            let totalEstimasi = {{ $totalEstimasi }} * 60; // konversi menit ke detik
            const countdownElement = document.getElementById('countdown_timer');

        function countdown() {
            if (totalEstimasi > 0) {
                const menit = Math.floor(totalEstimasi / 60);
                const detik = totalEstimasi % 60;
                countdownElement.textContent = `${menit} menit ${detik} detik`;
                totalEstimasi--;
                setTimeout(countdown, 1000);
            } else {
                countdownElement.textContent = 'Selesai!';
                
            }
        }

        countdown();
        });
    </script>
</body>
</html>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>