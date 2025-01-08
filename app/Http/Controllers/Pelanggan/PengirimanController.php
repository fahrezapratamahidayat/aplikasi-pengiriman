<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengiriman = Pengiriman::where('user_id', auth()->id())->get();
        return view('pelanggan.pengiriman.index', compact('pengiriman'));
    }

    public function create()
    {
        return view('pelanggan.pengiriman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'berat' => 'required|numeric|min:0',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'tinggi' => 'required|numeric|min:0',
            'alamat_pickup' => 'required',
            'alamat_tujuan' => 'required',
            'nama_penerima' => 'required',
            'telp_penerima' => 'required',
            'catatan' => 'nullable'
        ]);

        $pengiriman = new Pengiriman($validated);
        $pengiriman->user_id = auth()->id();
        $pengiriman->status = 'pending';
        $pengiriman->total_harga = $pengiriman->hitungHarga();
        $pengiriman->save();

        return redirect()->route('pelanggan.pengiriman.index')
            ->with('success', 'Permintaan pengiriman berhasil dibuat');
    }

    public function show(Pengiriman $pengiriman)
    {
        if ($pengiriman->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('pelanggan.pengiriman.show', compact('pengiriman'));
    }

    public function edit(Pengiriman $pengiriman)
    {
        if ($pengiriman->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah pengiriman sudah diapprove
        if ($pengiriman->status !== 'pending') {
            return redirect()->route('pelanggan.pengiriman.index')
                ->with('error', 'Pengiriman yang sudah diproses tidak dapat diubah');
        }

        return view('pelanggan.pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
        if ($pengiriman->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah pengiriman sudah diapprove
        if ($pengiriman->status !== 'pending') {
            return redirect()->route('pelanggan.pengiriman.index')
                ->with('error', 'Pengiriman yang sudah diproses tidak dapat diubah');
        }

        $validated = $request->validate([
            'nama_barang' => 'required',
            'berat' => 'required|numeric|min:0',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'tinggi' => 'required|numeric|min:0',
            'alamat_pickup' => 'required',
            'alamat_tujuan' => 'required',
            'nama_penerima' => 'required',
            'telp_penerima' => 'required',
            'catatan' => 'nullable'
        ]);

        $pengiriman->update($validated);
        $pengiriman->total_harga = $pengiriman->hitungHarga();
        $pengiriman->save();

        return redirect()->route('pelanggan.pengiriman.index')
            ->with('success', 'Pengiriman berhasil diupdate');
    }

    public function destroy(Pengiriman $pengiriman)
    {
        if ($pengiriman->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah pengiriman sudah diapprove
        if ($pengiriman->status !== 'pending') {
            return redirect()->route('pelanggan.pengiriman.index')
                ->with('error', 'Pengiriman yang sudah diproses tidak dapat dihapus');
        }

        $pengiriman->delete();

        return redirect()->route('pelanggan.pengiriman.index')
            ->with('success', 'Pengiriman berhasil dihapus');
    }
}
