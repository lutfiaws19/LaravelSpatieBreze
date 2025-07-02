<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $antrians = Antrian::all(); // Ambil semua data antrian
        return view('pelanggan.index', compact('antrians'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required',
            'nomor_motor' => 'required',
            'type_motor' => 'required',
            'status' => 'in:draft,dalam_antrian', // Pastikan status ini ada di database
        ]);

        $lastAntrian = Antrian::orderBy('nomor_antrian', 'desc')->first();
        $nomorAntrian = $lastAntrian ? $lastAntrian->nomor_antrian + 1 : 1;

        Antrian::create([
            'nama_pemilik' => $request->nama_pemilik,
            'nomor_motor' => $request->nomor_motor,
            'type_motor' => $request->type_motor,
            'nomor_antrian' => $nomorAntrian,
            'tanggal_masuk' => now(), // Menggunakan waktu saat ini
            'status' => $request->status, // Tambahkan status jika diperlukan
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Antrian berhasil ditambahkan!');
    }
}
