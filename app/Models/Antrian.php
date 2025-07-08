<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemilik',
        'nomor_motor',
        'type_motor',
        'nama_kerusakan',
        'estimasi_waktu',
        'nomor_antrian',
        'status',
        'tanggal_masuk',
    ];

    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class, 'nama_kerusakan', 'id');
    }

    public function penagihan()
    {
        return $this->hasOne(Penagihan::class);
    }
}