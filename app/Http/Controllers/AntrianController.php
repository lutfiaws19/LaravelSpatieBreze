<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\History;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class AntrianController extends Controller 
{
    // Menampilkan daftar antrian
    public function index(Request $request)
{
    $query = Antrian::query();

    // Filter berdasarkan nama pemilik
    if ($request->filled('nama_pemilik')) {
        $query->where('nama_pemilik', 'like', '%' . $request->nama_pemilik . '%');
    }

    // Filter berdasarkan tanggal masuk
    if ($request->filled('tanggal_masuk')) {
        $query->whereDate('tanggal_masuk', $request->tanggal_masuk);
    }

    $antrians = $query->get(); // Ambil data antrian yang sudah difilter

    return view('antrian.index', compact('antrians')); // Ganti 'antrian.index' dengan nama view Anda
}


    // Menampilkan form untuk menambah antrian
    public function create()
    {
        $ker = kerusakan::all();
        return view('antrian.create', compact('ker'));
    }

    // Menyimpan data antrian baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
        'nama_pemilik' => 'required|string|max:255',
        'nomor_motor' => 'required|string|max:255|unique:antrians',
        'type_motor' => 'required|string|max:255',
        'nama_kerusakan' => 'required|exists:kerusakans,id',
        'estimasi_waktu' => 'required|string',
        'status' => 'required|in:draft,dalam_antrian,selesai',
        ]);

        $lastAntrian = Antrian::orderBy('nomor_antrian', 'desc')->first();
        $nomorAntrian = $lastAntrian ? $lastAntrian->nomor_antrian + 1 : 1; // Jika tidak ada antrian, mulai dari 1
        
        $currentDateTime = now();
 

        Antrian::create([
            'nama_pemilik' => $request->nama_pemilik,
            'nomor_motor' => $request->nomor_motor,
            'type_motor' => $request->type_motor,
            'nama_kerusakan' => $request->nama_kerusakan,
            'estimasi_waktu' => $request->estimasi_waktu,
            'status' => $request->status,
            'nomor_antrian' =>$nomorAntrian,
            'tanggal_masuk' => $currentDateTime, // Menggunakan waktu saat ini
        ]);
    

        // Redirect ke halaman daftar antrian dengan pesan sukses
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil ditambahkan!');
    }

    // Menghapus antrian berdasarkan ID
    public function destroy($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->delete();

        // Redirect ke halaman daftar antrian dengan pesan sukses
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus!');
    }

    // Menampilkan detail antrian berdasarkan ID
    public function show($id)
    {
        $antrian = Antrian::findOrFail($id);
        return view('antrian.show', compact('antrian'));
    }

    // Menampilkan form untuk mengedit antrian
    public function edit($id)
    {
        $ker = Kerusakan::all();
        $antrian = Antrian::findOrFail($id);
        return view('antrian.edit', compact('antrian', 'ker'));
    }

    // Memperbarui data antrian berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nomor_motor' => 'required|string|max:255|unique:antrians,type_motor,' . $id,
            'type_motor' => 'required|string|max:255',
            'nama_kerusakan' => 'required|exists:kerusakans,id',
            'estimasi_waktu' => 'required|string|max:255',    
            'status' => 'required|in:draft,dalam_antrian,selesai',
        ]);

        

        // Mencari antrian berdasarkan ID dan memperbarui datanya
        $antrian = Antrian::findOrFail($id);
        $antrian->update($request->all());

        // Redirect ke halaman daftar antrian dengan pesan sukses
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil diperbarui!');
    }
    // Memindahkan data dari antrian ke history
public function pindahkanKeHistory($id)
{
    $antrian = Antrian::findOrFail($id);

    // Simpan data ke tabel histories
    History::create([
        'nama_pemilik' => $antrian->nama_pemilik,
        'nomor_motor' => $antrian->nomor_motor,
        'type_motor' => $antrian->type_motor,
        'status' => 'selesai', // atau $antrian->status jika kamu mau simpan status saat itu
    ]);

    // Hapus data antrian
    $antrian->delete();

    return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dipindahkan ke history!');
}

}