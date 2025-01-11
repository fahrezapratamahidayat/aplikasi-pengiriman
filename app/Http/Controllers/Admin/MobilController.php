<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return view('admin.mobil.index', compact('mobils'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_mobil' => 'required',
                'nomor_plat' => 'required|unique:mobils',
                'merk' => 'required',
                'warna' => 'required',
                'tahun' => 'required|numeric|min:1900|max:' . (date('Y') + 1),
                'status' => 'required|in:tersedia,disewa,perbaikan',
                'keterangan' => 'nullable'
            ]);

            Mobil::create($validated);

            return redirect()->route('admin.mobil.index')
                ->with('success', 'Mobil berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('admin.mobil.index')
                ->with('error', 'Gagal menambahkan mobil: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Mobil $mobil)
    {
        try {
            $validated = $request->validate([
                'nama_mobil' => 'required',
                'nomor_plat' => 'required|unique:mobils,nomor_plat,'.$mobil->id,
                'merk' => 'required',
                'warna' => 'required',
                'tahun' => 'required|numeric|min:1900|max:' . (date('Y') + 1),
                'status' => 'required|in:tersedia,disewa,perbaikan',
                'keterangan' => 'nullable'
            ]);

            $mobil->update($validated);

            return redirect()->route('admin.mobil.index')
                ->with('success', 'Mobil berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('admin.mobil.index')
                ->with('error', 'Gagal mengupdate mobil: ' . $e->getMessage());
        }
    }

    public function destroy(Mobil $mobil)
    {
        try {

            if ($mobil->pengiriman()->whereIn('status', ['approved', 'pickup', 'dalam_pengiriman'])->exists()) {
                return redirect()->route('admin.mobil.index')
                    ->with('error', 'Mobil sedang digunakan dalam pengiriman aktif');
            }

            $mobil->delete();

            return redirect()->route('admin.mobil.index')
                ->with('success', 'Mobil berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.mobil.index')
                ->with('error', 'Gagal menghapus mobil: ' . $e->getMessage());
        }
    }
}
