<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'pelanggan_id',
        'message',
        'is_read'
    ];

    // Relasi ke model User (admin pengirim)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relasi ke model User (pelanggan penerima)
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }
}

