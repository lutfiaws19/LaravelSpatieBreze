<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-indigo-800 tracking-tight">
                <i class="fas fa-motorcycle mr-3"></i> Dashboard Bengkel Motor
            </h2>
            <div class="flex space-x-2">
                <div class="text-sm px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full">
                    <i class="far fa-calendar-alt mr-1"></i> {{ now()->format('d F Y') }}
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                padding: 2rem 0;
            }
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
    </x-slot>

    <div class="container-fluid mt-4 mb-5 px-4">
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
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('antrian.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input type="text" name="nama_pemilik" class="form-control" placeholder="Cari nama pemilik..." value="{{ request('nama_pemilik') }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="date" name="tanggal_masuk" class="form-control" placeholder="Filter Tanggal Masuk" value="{{ request('tanggal_masuk') }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="table table-bordered table-striped">
                <thead class="bg-gray-50">
                    <tr>
                        <th>No</th>
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
                        $totalEstimasi = 0;
                    @endphp
                    @foreach ($antrians as $antrian)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $antrian->nama_pemilik }}</td>
                            <td>{{ $antrian->nomor_motor }}</td>
                            <td>{{ $antrian->type_motor }}</td>
                            <td>{{ $antrian->Kerusakan->nama_kerusakan }}</td>
                            <td>
                                @php
                                    $estimasiWaktu = $antrian->Kerusakan->estimasi_waktu;
                                    $totalEstimasi += $estimasiWaktu;
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
                                    @if(Auth::user()->hasRole('Admin'))
                                        <a href="{{ route('penagihan.create', $antrian->id) }}" class="btn btn-info btn-sm mb-1 ml-1">
                                            <i class="fas fa-envelope"></i> Tagih
                                        </a>
                                        @if($antrian->penagihan)
                                            <a href="{{ route('penagihan.edit', $antrian->penagihan->id) }}" class="btn btn-secondary btn-sm mb-1 ml-1">
                                                <i class="fas fa-edit"></i> Edit Tagihan
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="alert alert-info mt-4">
            <strong>Total Estimasi Waktu:</strong> <span id="total_estimasi">{{ $totalEstimasi }}</span> menit
            <strong>Countdown:</strong> <span id="countdown_timer"></span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let totalEstimasi = {{ $totalEstimasi }} * 60;
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
</x-app-layout>