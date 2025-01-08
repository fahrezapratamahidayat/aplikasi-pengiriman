<?php

namespace App\Http\Controllers\Supir;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\TrackingLokasi;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::where('supir_id', auth()->id())->get();
        return view('supir.pengiriman.index', compact('pengiriman'));
    }

    public function show(Pengiriman $pengiriman)
    {
        if ($pengiriman->supir_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('supir.pengiriman.show', compact('pengiriman'));
    }

    public function updateStatus(Request $request, Pengiriman $pengiriman)
    {
        $validated = $request->validate([
            'status' => 'required|in:pickup,dalam_pengiriman,selesai',
        ]);

        $pengiriman->update(['status' => $validated['status']]);

        if ($validated['status'] === 'selesai') {
            $pengiriman->mobil->update(['status' => 'tersedia']);
        }

        return redirect()->route('supir.pengiriman.index')
            ->with('success', 'Status pengiriman berhasil diupdate');
    }

    public function updateLokasi(Request $request, Pengiriman $pengiriman)
    {
        $validated = $request->validate([
            'maps_link' => 'required|url',
            'keterangan' => 'nullable',
        ]);

        TrackingLokasi::create([
            'pengiriman_id' => $pengiriman->id,
            'maps_link' => $validated['maps_link'],
            'keterangan' => $validated['keterangan'],
        ]);

        return response()->json(['message' => 'Lokasi berhasil diupdate']);
    }
}
