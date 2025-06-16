<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PembagianZakat;
use App\Models\PenyaluranZakat;
use App\Models\PenerimaZakat;
use App\Models\StatusPembagian;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembagianZakatController extends Controller
{
public function index()
{
    $pembagianList = PembagianZakat::withCount('penyaluran')
        ->with(['penyaluran.penerima'])
        ->get()
        ->map(function ($item) {
            // Hitung jumlah penerima unik
            $item->jumlah_penerima = $item->penyaluran->pluck('penerimaId')->unique()->count();
            return $item;
        });

    return view('admin.pembagianZakat', compact('pembagianList'));
}


public function tambahTahunIni()
{
    $tahun = Carbon::now()->year;

    // Cek apakah sudah ada untuk tahun ini
    $sudahAda = PembagianZakat::where('tahun', $tahun)->exists();

    if (!$sudahAda) {
        PembagianZakat::create([
            'tahun' => $tahun
        ]);

        return redirect()->route('pembagian.index')->with('success', 'Data tahun ' . $tahun . ' berhasil ditambahkan.');
    } else {
        return redirect()->route('pembagian.index')->with('info', 'Data tahun ' . $tahun . ' sudah tersedia.');
    }
}

public function showYear($id)
{
    $tahun = PembagianZakat::findOrFail($id);

    $penyalurans = PenyaluranZakat::with(['penerima', 'status', 'jenis', 'amil'])
        ->where('pembagianId', $id)
        ->orderBy('penyaluranId', 'desc')
        ->get();

    return view('admin.penyaluranZakat', compact('tahun', 'penyalurans'));
}

}
