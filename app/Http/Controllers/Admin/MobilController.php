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
        $validated = $request->validate([
            'nama_mobil' => 'required',
            'nomor_plat' => 'required|unique:mobils',
            'merk' => 'required',
            'warna' => 'required',
            'tahun' => 'required|numeric',
            'status' => 'required|in:tersedia,disewa,perbaikan',
            'keterangan' => 'nullable'
        ]);

        Mobil::create($validated);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil ditambahkan');
    }

    public function update(Request $request, Mobil $mobil)
    {
        $validated = $request->validate([
            'nama_mobil' => 'required',
            'nomor_plat' => 'required|unique:mobils,nomor_plat,'.$mobil->id,
            'merk' => 'required',
            'warna' => 'required',
            'tahun' => 'required|numeric',
            'status' => 'required|in:tersedia,disewa,perbaikan',
            'keterangan' => 'nullable'
        ]);

        $mobil->update($validated);

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil diupdate');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();

        return redirect()->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil dihapus');
    }
}
