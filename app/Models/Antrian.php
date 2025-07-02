<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

     // Tambahkan properti fillable
    protected $fillable = [
        'nama_pemilik',
        'nomor_motor',
        'type_motor',// Jika ingin menyimpan type motor
        'nama_kerusakan', // Jika ingin menyimpan id kerusakan
        'estimasi_waktu',
        'nomor_antrian',// Jika ingin menyimpan nomor antrian
        'status',// Jika ingin menyimpan status
        'tanggal_masuk', // Jika ingin menyimpan tanggal masuk
        
    ];
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class , 'nama_kerusakan', 'id');
    }
}
