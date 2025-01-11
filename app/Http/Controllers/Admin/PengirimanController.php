<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\User;
use App\Models\Mobil;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::with(['pelanggan', 'supir', 'mobil'])->get();
        return view('admin.pengiriman.index', compact('pengiriman'));
    }

    public function show(Pengiriman $pengiriman)
    {
        // Ambil supir yang tidak sedang dalam pengiriman
        $supirs = User::where('role_id', 2)
            ->whereDoesntHave('pengirimanSupir', function($query) {
                $query->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman']);
            })
            ->get();

        // Ambil mobil yang tersedia
        $mobils = Mobil::where('status', 'tersedia')->get();

        return view('admin.pengiriman.show', compact('pengiriman', 'supirs', 'mobils'));
    }

    public function approve(Request $request, Pengiriman $pengiriman)
    {
        $validated = $request->validate([
            'supir_id' => 'required|exists:users,id',
            'mobil_id' => 'required|exists:mobils,id',
        ]);

        // Cek lagi apakah supir masih tersedia
        $supirTersedia = User::where('id', $validated['supir_id'])
            ->whereDoesntHave('pengirimanSupir', function($query) {
                $query->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman']);
            })
            ->exists();

        if (!$supirTersedia) {
            return back()->with('error', 'Supir sudah tidak tersedia. Silakan pilih supir lain.');
        }

        // Cek lagi apakah mobil masih tersedia
        $mobilTersedia = Mobil::where('id', $validated['mobil_id'])
            ->where('status', 'tersedia')
            ->exists();

        if (!$mobilTersedia) {
            return back()->with('error', 'Mobil sudah tidak tersedia. Silakan pilih mobil lain.');
        }

        $pengiriman->update([
            'status' => 'approved',
            'supir_id' => $validated['supir_id'],
            'mobil_id' => $validated['mobil_id'],
        ]);

        // Update status mobil
        $mobil = Mobil::find($validated['mobil_id']);
        $mobil->update(['status' => 'disewa']);

        return redirect()->route('admin.pengiriman.index')
            ->with('success', 'Pengiriman berhasil disetujui');
    }

    public function reject(Pengiriman $pengiriman)
    {
        $pengiriman->update(['status' => 'rejected']);
        return redirect()->route('admin.pengiriman.index')
            ->with('success', 'Pengiriman ditolak');
    }
}
