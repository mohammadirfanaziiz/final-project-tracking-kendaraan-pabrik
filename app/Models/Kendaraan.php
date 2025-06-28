<?php

namespace App\Models;

use App\Models\Rute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';
    protected $fillable = [
        'nomor_polisi', 
        'jenis',  
        'rute_ditugaskan_id',
    ];

     protected $guarded = ['id'];

    // Relasi ke model Rute (One to Many atau Many to One)
    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_ditugaskan_id');
    }
}
