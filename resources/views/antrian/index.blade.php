<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Antrian Bengkel Motor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Tambahkan Font Awesome -->
    <style>
        .card-title { font-size: 1rem; font-weight: 500; }
        .card-text { font-size: 1.75rem; font-weight: 700; }
        .bg-primary { background: linear-gradient(45deg, #3a7bd5, #00d2ff) !important; }
        .bg-warning { background: linear-gradient(45deg, #f46b45, #eea849) !important; }
        .bg-success { background: linear-gradient(45deg, #11998e, #38ef7d) !important; }
        .card { border-radius: 0.5rem; overflow: hidden; }
        .table th, .table td { vertical-align: middle; }
        .badge { font-size: 0.9rem; }
        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #7c3aed, #4f46e5);
        }
        .alert-info {
            background-color: #e0f7fa;
            color: #00796b;
        }
    </style>
</head>
<x-app-layout>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Antrian</h5>
                        <h3 class="card-text">{{ $totalAntrian }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Dalam Proses</h5>
                        <h3 class="card-text">{{ $prosesAntrian }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Selesai</h5>
                        <h3 class="card-text">{{ $selesaiAntrian }}</h3>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('Admin'))
            <a href="{{ route('antrian.create') }}" class="btn btn-primary mb-4">
                <i class="fas fa-plus mr-2"></i> Tambah Antrian
            </a>
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
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Motor</th>
                    <th>Type Motor</th>
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
                @endphp
                @foreach ($antrians as $antrian)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $antrian->nama_pemilik }}</td>
                        <td>{{ $antrian->nomor_motor }}</td>
                        <td>{{ $antrian->type_motor }}</td>
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
                            <div class="d-flex flex-wrap align-items-center gap-1">
                                <a href="{{ route('antrian.edit', $antrian->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('antrian.destroy', $antrian->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus antrian ini?');" class="mb-1 ml-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                                <form action="{{ route('antrian.toHistory', $antrian->id) }}" method="POST" style="display:inline;" class="mb-1 ml-1">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Pindahkan antrian ini ke riwayat?')">
                                        <i class="fas fa-check"></i> Selesaikan
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-app-layout>