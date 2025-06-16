<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PembayaranZakat;
use App\Models\TransaksiZakat;
use Barryvdh\DomPDF\Facade\Pdf;


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

public function exportPdf($tahun)
{
    // Ambil ID dari tabel pembayaran_zakat berdasarkan tahun
    $pembayaranZakat = PembayaranZakat::where('tahun', $tahun)->first();

    if (!$pembayaranZakat) {
        return redirect()->back()->with('error', 'Data pembayaran untuk tahun tersebut tidak ditemukan.');
    }

    // Ambil semua transaksi berdasarkan pembayaranZakatId dan relasi lainnya
    $transaksis = TransaksiZakat::with(['user', 'jenis', 'statusPembayaran', 'bentuk'])
        ->where('pembayaranZakatId', $pembayaranZakat->pembayaranZakatId)
        ->get();

    if ($transaksis->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada transaksi untuk tahun tersebut.');
    }

    // Kirim ke view PDF
    $pdf = Pdf::loadView('admin.templatePDF.template', [
        'transaksis' => $transaksis,
        'tahun' => $tahun
    ])->setPaper('A4', 'portrait');

    return $pdf->download("transaksi-zakat-$tahun.pdf");
}




}
