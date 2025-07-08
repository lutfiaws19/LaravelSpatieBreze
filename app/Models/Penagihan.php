<?php

namespace App\Models;

use App\Models\Antrian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'antrian_id',
        'pesan',
    ];

    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }
}