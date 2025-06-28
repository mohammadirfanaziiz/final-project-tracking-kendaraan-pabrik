<?php

namespace App\Models;

use App\Models\RuteTujuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rute extends Model
{
    use HasFactory;

     protected $table = 'rutes';
     protected $fillable = [
        'asal',
        'tujuan',
        'latitude',
        'longitude', 
        
    ];

    // Relasi ke Kendaraan (One to Many)
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'rute_ditugaskan_id');
    }

}
