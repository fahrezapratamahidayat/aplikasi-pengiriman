<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingLokasi extends Model
{
    use HasFactory;

    protected $table = 'tracking_lokasi';

    protected $fillable = [
        'pengiriman_id',
        'maps_link',
        'keterangan'
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }
}
