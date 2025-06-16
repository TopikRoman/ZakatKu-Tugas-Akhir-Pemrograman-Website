<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; // ✅ tambahkan ini!
use App\Models\PenerimaZakat;
use Illuminate\Http\Request;


class PenerimaZakatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penerimas = PenerimaZakat::with('penyaluran')->get();
        return view('admin.penerima_zakat.index', compact('penerimas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKepalaKeluarga' => 'required',
            'alamat' => 'required',
            'noTelepon' => 'required',
        ]);

        PenerimaZakat::create($request->only(['namaKepalaKeluarga', 'alamat', 'noTelepon']));

        return redirect()->route('penerima_zakat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, PenerimaZakat $penerima_zakat)
    {
        $request->validate([
            'namaKepalaKeluarga' => 'required',
            'alamat' => 'required',
            'noTelepon' => 'required',
        ]);

        $penerima_zakat->update($request->only(['namaKepalaKeluarga', 'alamat', 'noTelepon']));

        return redirect()->route('penerima_zakat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(PenerimaZakat $penerima_zakat)
    {
        $penerima_zakat->delete();
        return redirect()->route('penerima_zakat.index')->with('success', 'Data berhasil dihapus.');
    }
}
