<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupirController extends Controller
{
    public function index()
    {
        $supirs = User::where('role_id', 2)->get();
        return view('admin.supir.index', compact('supirs'));
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
            'role_id' => 2,
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.supir.index')
            ->with('success', 'Supir berhasil ditambahkan');
    }

    public function update(Request $request, User $supir)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$supir->id,
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $supir->update($validated);

        return redirect()->route('admin.supir.index')
            ->with('success', 'Supir berhasil diupdate');
    }

    public function destroy(User $supir)
    {
        $supir->delete();

        return redirect()->route('admin.supir.index')
            ->with('success', 'Supir berhasil dihapus');
    }
}
