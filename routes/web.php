<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PenagihanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
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
Route::get('penagihan/{antrian}/create', [PenagihanController::class, 'create'])->name('penagihan.create');
Route::post('penagihan/{antrian}', [PenagihanController::class, 'store'])->name('penagihan.store');
Route::get('penagihan/{antrian}/show', [PenagihanController::class, 'show'])->name('penagihan.show');
Route::get('penagihan/{penagihan}/edit', [PenagihanController::class, 'edit'])->name('penagihan.edit');
Route::put('penagihan/{penagihan}', [PenagihanController::class, 'update'])->name('penagihan.update');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::delete('/chat/message/{message}', [ChatController::class, 'destroy'])->name('chat.message.destroy');
Route::delete('/chat/reset/{receiver_id}', [ChatController::class, 'reset'])->name('chat.reset');