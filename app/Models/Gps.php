<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    use HasFactory;
    protected $table = 'gps';

    protected $fillable = [
        'latitude',
        'longitude',
        'timestamp',
        'pengiriman_id',
    ];

    // public $timestamps = false;

    // Relasi ke pengiriman
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }
}
