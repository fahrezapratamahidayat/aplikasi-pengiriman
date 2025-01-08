<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\User;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik pengiriman
        $totalPengiriman = Pengiriman::count();
        $pengirimanSelesai = Pengiriman::where('status', 'selesai')->count();
        $dalamPengiriman = Pengiriman::whereIn('status', ['approved', 'pickup', 'dalam_pengiriman'])->count();
        $totalPendapatan = Pengiriman::sum('total_harga');

        // Ambil 5 pengiriman terbaru
        $recentPengiriman = Pengiriman::with(['pelanggan'])
            ->latest()
            ->take(5)
            ->get();

        // Hitung performa kurir
        $kurirPerformance = User::where('role_id', 2) // role_id 2 untuk supir
            ->withCount(['pengirimanSupir as completed_deliveries' => function($query) {
                $query->where('status', 'selesai');
            }])
            ->withCount(['pengirimanSupir as total_deliveries'])
            ->get()
            ->map(function($kurir) {
                $kurir->success_rate = $kurir->total_deliveries > 0
                    ? round(($kurir->completed_deliveries / $kurir->total_deliveries) * 100)
                    : 0;
                return $kurir;
            });

        return view('admin.dashboard', compact(
            'totalPengiriman',
            'pengirimanSelesai',
            'dalamPengiriman',
            'totalPendapatan',
            'recentPengiriman',
            'kurirPerformance'
        ));
    }
}
