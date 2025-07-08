<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Penagihan;

class DashboardController extends Controller
{
  public function index()
{
    $totalAntrian = \App\Models\Antrian::count();
    $prosesAntrian = \App\Models\Antrian::where('status', 'dalam_antrian')->count();
    $selesaiAntrian = \App\Models\Antrian::where('status', 'selesai')->count();
    $antrians = \App\Models\Antrian::with('Kerusakan')->get();
    return view('dashboard', compact('totalAntrian', 'prosesAntrian', 'selesaiAntrian'));
}
}