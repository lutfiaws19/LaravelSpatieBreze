<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Penagihan;
use Illuminate\Http\Request;

class PenagihanController extends Controller
{
    // Tampilkan form penagihan
    public function create($antrian_id)
    {
        $antrian = Antrian::findOrFail($antrian_id);
        return view('penagihan.create', compact('antrian'));
    }

    // Simpan penagihan
    public function store(Request $request, $antrian_id)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        Penagihan::create([
            'antrian_id' => $antrian_id,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('antrian.index')->with('success', 'Pesan penagihan berhasil dikirim!');
    }

    public function show($antrian_id)
    {
        $antrian = \App\Models\Antrian::findOrFail($antrian_id);
        $penagihan = $antrian->penagihan;
        return view('penagihan.show', compact('antrian', 'penagihan'));
    }
    public function edit(Penagihan $penagihan)
    {
        $antrian = $penagihan->antrian;
        return view('penagihan.edit', compact('penagihan', 'antrian'));
    }

    public function update(Request $request, Penagihan $penagihan)
    {
        $request->validate([
        'pesan' => 'required|string',
        ]);

        $penagihan->update([
        'pesan' => $request->pesan,
        ]);

        return redirect()->route('penagihan.show', $penagihan->antrian_id)->with('success', 'Pesan penagihan berhasil diupdate!');
    }
}