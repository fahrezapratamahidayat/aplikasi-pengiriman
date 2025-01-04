<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = User::where('role_id', 3)->get();
        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 3,
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, User $pelanggan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$pelanggan->id,
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil diupdate');
    }

    public function destroy(User $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}
