<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mobil',
        'nomor_plat',
        'merk',
        'warna',
        'tahun',
        'status',
        'keterangan'
    ];

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class);
    }
}
