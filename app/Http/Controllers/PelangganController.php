<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk Auth

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
    // Validasi field lain (nama_pemilik, dsb)
    $request->validate([
        'nama_pemilik' => 'required|string|max:255',
        'nomor_motor' => 'required|string|max:100',
        'type_motor' => 'required|string|max:100',
        'nomor_antrian' => 'required|string|max:100',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|string',
        // tidak perlu validasi nama_kerusakan jika tidak wajib
    ]);

    Antrian::create([
        'nama_pemilik' => $request->nama_pemilik,
        'nomor_motor' => $request->nomor_motor,
        'type_motor' => $request->type_motor,
        'nomor_antrian' => $request->nomor_antrian,
        'tanggal_masuk' => $request->tanggal_masuk,
        'status' => $request->status,
        'nama_kerusakan' => $request->input('nama_kerusakan', ''), // <- baris penting
    ]);

    return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan');
}

}