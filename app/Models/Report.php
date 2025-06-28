<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

     protected $table = 'reports';

    protected $fillable = [
        'tanggal',
        'persentase_tepat_waktu',
        'persentase_terlambat',
        'waktu_rata_rata_pengiriman',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
