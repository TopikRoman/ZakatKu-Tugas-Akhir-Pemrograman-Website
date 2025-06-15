<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MuzakkiController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan roleId = 2 (Muzakki)
        $muzakkis = User::where('roleId', 2)->get();
        return view('admin.muzakki.index', compact('muzakkis'));
    }

    public function create()
    {
        return view('admin.muzakki.create');
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

        $validated['roleId'] = 2;
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('muzakki.index')->with('success', 'Muzakki berhasil ditambahkan');
    }

    public function show(User $muzakki)
    {
        return view('admin.muzakki.show', compact('muzakki'));
    }

    public function edit(User $muzakki)
    {
        return view('admin.muzakki.edit', compact('muzakki'));
    }

    public function update(Request $request, User $muzakki)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username,' . $muzakki->id,
                'email' => 'required|email|unique:users,email,' . $muzakki->id,
                'alamat' => 'required|string',
                'nomorTelepon' => 'required|string',
                'password' => 'nullable|string|min:6',
            ]);

            if ($request->filled('password')) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']);
            }

            $validated['roleId'] = 2;

            $muzakki->update($validated);

            return redirect()->route('muzakki.index')->with('success', 'Muzakki berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('muzakki.index')->with('error', 'Gagal memperbarui muzakki!');
        }
    }

    public function destroy(User $muzakki)
    {
        $muzakki->delete();
        return redirect()->route('muzakki.index')->with('success', 'Muzakki berhasil dihapus');
    }
}
