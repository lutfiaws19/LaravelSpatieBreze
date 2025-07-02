<x-app-layout>
    <x-slot name="header">
        <h1>History</h1>
    </x-slot>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Motor</th>
                    <th>Type Motor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $index => $history)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $history->nama_pemilik }}</td>
                        <td>{{ $history->nomor_motor }}</td>
                        <td>{{ $history->type_motor }}</td>
                        <td>
                            @if ($history->status == 'dalam_antrian')
                                <span class="badge badge-warning">Dalam Antrian</span>
                            @elseif ($history->status == 'draft')
                                <span class="badge badge-secondary">Draft</span>
                            @elseif ($history->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-light">Status Tidak Dikenal</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('history.destroy', $history->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus history ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data history.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>