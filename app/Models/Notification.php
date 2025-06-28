<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

     protected $table = 'notifications';

    protected $fillable = [
        'pesan',
        'penerima_id',
        'jenis',
        'waktu_dibuat',
    ];

    public $timestamps = false; // karena kita pakai waktu_dibuat manual

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
