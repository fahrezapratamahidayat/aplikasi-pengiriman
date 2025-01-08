<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Mobil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $supirId = auth()->id();

        // Hitung statistik
        $totalPengiriman = Pengiriman::where('supir_id', $supirId)->count();
        $pengirimanSelesai = Pengiriman::where('supir_id', $supirId)
            ->where('status', 'selesai')
            ->count();
        $dalamPengiriman = Pengiriman::where('supir_id', $supirId)
            ->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman'])
            ->count();

        // Ambil data mobil yang sedang digunakan
        $mobil = Mobil::whereHas('pengiriman', function($query) use ($supirId) {
            $query->where('supir_id', $supirId)
                ->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman']);
        })->first();

        // Ambil pengiriman aktif
        $activePengiriman = Pengiriman::where('supir_id', $supirId)
            ->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman'])
            ->get();

        return view('supir.dashboard', compact(
            'totalPengiriman',
            'pengirimanSelesai',
            'dalamPengiriman',
            'mobil',
            'activePengiriman'
        ));
    }
}
