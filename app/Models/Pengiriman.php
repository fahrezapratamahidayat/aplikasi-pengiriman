<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'user_id',
        'nama_barang',
        'berat',
        'panjang',
        'lebar',
        'tinggi',
        'alamat_pickup',
        'alamat_tujuan',
        'nama_penerima',
        'telp_penerima',
        'total_harga',
        'status',
        'supir_id',
        'mobil_id',
        'catatan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supir()
    {
        return $this->belongsTo(User::class, 'supir_id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function tracking()
    {
        return $this->hasMany(TrackingLokasi::class);
    }

    // Hitung total harga berdasarkan berat
    public function hitungHarga()
    {
        $hargaPerKg = 10000; // Rp 10.000 per kg
        return $this->berat * $hargaPerKg;
    }
}
