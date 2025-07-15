<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan; 
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        $antrians = Antrian::all(); 
        return view('pelanggan.index', compact('antrians'));
    }

    public function create()
    {
        $ker = Kerusakan::all();
        return view('pelanggan.create', compact('ker'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nomor_motor' => 'required|string|max:100|unique:antrians',
            'type_motor' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
        ]);

        $lastAntrian = Antrian::orderBy('nomor_antrian', 'desc')->first();
        $nomorAntrian = $lastAntrian ? $lastAntrian->nomor_antrian + 1 : 1; 
        
        Antrian::create([
            'nama_pemilik' => $request->nama_pemilik,
            'nomor_motor' => $request->nomor_motor,
            'type_motor' => $request->type_motor,
            'nomor_antrian' => $nomorAntrian, // Gunakan nomor antrian yang baru
            'tanggal_masuk' => $request->tanggal_masuk, // Gunakan waktu yang diinput
            'status' => 'draft', 
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Antrian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $antrian = Antrian::findOrFail($id);
        return view('antrian.edit', compact('antrian', 'ker'));
    }
}
