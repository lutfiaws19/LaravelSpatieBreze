<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk otentikasi
require __DIR__.'/auth.php';

// Rute yang memerlukan otentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/antrian/{id}/pindah-ke-history', [AntrianController::class, 'pindahkanKeHistory'])->name('antrian.toHistory');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('antrian', AntrianController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('kerusakan', KerusakanController::class);

    Route::get('/my-role', function () {
        return auth()->user()->roles;
    });

   
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('history.destroy');
    
});


// Rute untuk halaman antrian (jika ingin terpisah)
Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index')->middleware('auth');
