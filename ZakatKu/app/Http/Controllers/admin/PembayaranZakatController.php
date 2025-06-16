<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PembayaranZakat;
use App\Models\TransaksiZakat;

class PembayaranZakatController extends Controller
{

public function index()
{
    $years = PembayaranZakat::withCount(['transaksi as total_transaksi', 'transaksi as total_pending' => function($q) {
        $q->whereHas('statusPembayaran', fn($q2) => $q2->where('statusPembayaranId', 3));
    }])->orderBy('tahun', 'desc')->get();

    return view('admin.pembayaranZakat', compact('years'));
}

public function tambahTahunIni()
{
    $tahun = Carbon::now()->year;

    // Cek apakah sudah ada untuk tahun ini
    $sudahAda = PembayaranZakat::where('tahun', $tahun)->exists();

    if (!$sudahAda) {
        PembayaranZakat::create([
            'tahun' => $tahun
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data tahun ' . $tahun . ' berhasil ditambahkan.');
    } else {
        return redirect()->route('admin.pembayaran.index')->with('info', 'Data tahun ' . $tahun . ' sudah tersedia.');
    }
}

public function showYear($id)
{
    $tahun = PembayaranZakat::findOrFail($id);

    $transaksis = TransaksiZakat::with('user', 'statusPembayaran')
        ->where('pembayaranZakatId', $id)
        ->orderBy('tanggalTransaksi', 'desc')
        ->get();

    return view('admin.transaksiZakat', compact('tahun', 'transaksis'));
}

public function listMenungguVerifikasi()
{
    $transaksis = TransaksiZakat::with(['user', 'jenis', 'statusPembayaran'])
                    ->where('statusPembayaranId', 3)
                    ->orderBy('tanggalTransaksi', 'desc')
                    ->get();

    return view('admin.transaksiPending', compact('transaksis'));
}


public function editStatus($id)
{
    $transaksi = TransaksiZakat::with('user')->findOrFail($id);
    return view('admin.editStatusPembayaran', compact('transaksi'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'statusPembayaranId' => 'required|in:1,2,3,4'
    ]);

    $transaksi = TransaksiZakat::findOrFail($id);
    $transaksi->statusPembayaranId = $request->statusPembayaranId;
    $transaksi->save();

    return redirect()->route('admin.zakat.editStatus', $id)->with('success', 'Status pembayaran berhasil diperbarui.');
}


}
