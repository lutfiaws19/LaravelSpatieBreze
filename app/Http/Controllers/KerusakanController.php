<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use App\Models\Antrian;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    // Menampilkan semua data kerusakan
    public function index()
    {
        $kerusakans = Kerusakan::all();
        return view('kerusakan.index', compact('kerusakans'));
    }

    // Menampilkan form untuk menambah kerusakan
    public function create()
    {
        return view('kerusakan.create');
    }

    // Menyimpan data kerusakan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kerusakan' => 'required|string|max:255',
            'estimasi_waktu' => 'integer',
        ]);

        $kerusakan = Kerusakan::create($request->all());
        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil ditambahkan.');
    }

    // Menampilkan data kerusakan berdasarkan ID
    public function show($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        return response()->json($kerusakan);
    }

    // Menampilkan form untuk mengedit kerusakan
    public function edit($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        return view('kerusakan.edit', compact('kerusakan'));
    }

    // Mengupdate data kerusakan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kerusakan' => 'sometimes|required|string|max:255',
            'estimasi_waktu' => 'sometimes|integer',
        ]);

        $kerusakan = Kerusakan::findOrFail($id);
        $kerusakan->update($request->all());
        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil diperbarui.');
    }

    // Menghapus data kerusakan
    public function destroy($id)
    {
        $kerusakan = Kerusakan::findOrFail($id);
        $kerusakan->delete();
        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil dihapus.');
    }
}