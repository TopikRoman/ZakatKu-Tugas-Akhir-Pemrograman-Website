<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\TransaksiZakat;

class RiwayatPembayaranZakat extends Controller
{
    public function riwayat()
    {
        $riwayat = TransaksiZakat::with(['jenis', 'statusPembayaran'])
            ->where('userId', Auth::id())
            ->orderByDesc('tanggalTransaksi')
            ->get();

        return view('user.riwayatPembayaranZakat', compact('riwayat'));
    }

    public function redirect($id)
    {
        $riwayat = TransaksiZakat::with(['jenis', 'statusPembayaran'])->findOrFail($id);
        $statusId = $riwayat->statusPembayaranId;

        return match ($statusId) {
            4 => redirect()->route('riwayat.bayar', $riwayat->transaksiZakatId),
            2 => redirect()->route('riwayat.selesai', $riwayat->transaksiZakatId),
            3 => redirect()->route('riwayat.menunggu', $riwayat->transaksiZakatId),
            default => abort(404),
        };
    }

    public function bayar($id)
    {
        $riwayat = TransaksiZakat::with(['user', 'jenis', 'bentuk', 'pembayaranZakat'])->findOrFail($id);
        return view('user.halamanBayar', compact('riwayat'));
    }

    public function menunggu($id)
    {
        $riwayat = TransaksiZakat::with(['user', 'jenis', 'bentuk', 'pembayaranZakat'])->findOrFail($id);
        return view('user.halamanMenunggu', compact('riwayat'));
    }

    public function selesai($id)
    {
        $riwayat = TransaksiZakat::with(['user', 'jenis', 'bentuk', 'pembayaranZakat'])->findOrFail($id);
        return view('user.halamanLunas', compact('riwayat'));
    }

}
