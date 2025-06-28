<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman'; 

    // Menambahkan konstanta untuk status
    const STATUS_OTW = 'OTW';
    const STATUS_SELESAI = 'Selesai';

    protected $fillable = [
        'kendaraan_id',
        'driver_id',
        'rute_id',
        'status',
        'deskripsi_barang',
        'estimasi_kedatangan',
        'kedatangan_sebenarnya',
        'waktu_dibuat'
    ];

    // Cast status ke string agar bisa menggunakan enum
    protected $casts = [
        'status' => 'string',
    ];

    // Relasi dengan kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // Relasi dengan driver (menggunakan user_id sebagai driver)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Relasi dengan rute
    public function rute()
    {
        return $this->belongsTo(Rute::class);
    }

    // Relasi dengan gps untuk mengambil data GPS terakhir
    public function latest_gps()
    {
        return $this->hasOne(\App\Models\Gps::class)->latestOfMany('timestamp');  // Pastikan 'timestamp' ada di tabel gps
    }

    // Relasi dengan gps untuk mengambil semua data GPS terkait pengiriman
    public function gps()
    {
        return $this->hasMany(Gps::class, 'pengiriman_id');
    }

    // Getter untuk status yang menampilkan dengan kapitalisasi
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Menampilkan status dengan kapitalisasi pertama
    }

    // Method untuk memeriksa apakah statusnya 'OTW'
    public function isOtw()
    {
        return $this->status === self::STATUS_OTW;
    }

    // Method untuk memeriksa apakah statusnya 'Selesai'
    public function isSelesai()
    {
        return $this->status === self::STATUS_SELESAI;
    }
}
