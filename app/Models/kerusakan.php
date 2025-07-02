<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kerusakan',
        'estimasi_waktu',
    ];
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
