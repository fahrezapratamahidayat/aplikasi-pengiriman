<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Hitung statistik
        $totalPengiriman = Pengiriman::where('user_id', $userId)->count();
        $pengirimanSelesai = Pengiriman::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();
        $dalamPengiriman = Pengiriman::where('user_id', $userId)
            ->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman'])
            ->count();
        $totalPengeluaran = Pengiriman::where('user_id', $userId)
            ->sum('total_harga');

        // Ambil 5 pengiriman terbaru
        $recentPengiriman = Pengiriman::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('pelanggan.dashboard', compact(
            'totalPengiriman',
            'pengirimanSelesai',
            'dalamPengiriman',
            'totalPengeluaran',
            'recentPengiriman'
        ));
    }
}
