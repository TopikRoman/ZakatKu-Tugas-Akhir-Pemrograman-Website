<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AmilController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan roleId = 1 (Amil)
        $amils = User::where('roleId', 1)->get();
        return view('admin.amil.index', compact('amils'));
    }

    public function create()
    {
        return view('admin.amil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'alamat' => 'required|string',
            'nomorTelepon' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $validated['roleId'] = 1; // Amil
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('amil.index')->with('success', 'Amil berhasil ditambahkan');
    }

    public function show(User $amil)
    {
        return view('admin.amil.show', compact('amil'));
    }

    public function edit(User $amil)
    {
        return view('admin.amil.edit', compact('amil'));
    }

    public function update(Request $request, User $amil)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $amil->id,
            'email' => 'required|email|unique:users,email,' . $amil->id,
            'alamat' => 'required|string',
            'nomorTelepon' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $validated['roleId'] = 1;

        $amil->update($validated);

        return redirect()->route('amil.index')->with('success', 'Amil berhasil diperbarui');
    }

    public function destroy(User $amil)
    {
        $amil->delete();
        return redirect()->route('amil.index')->with('success', 'Amil berhasil dihapus');
    }
}
