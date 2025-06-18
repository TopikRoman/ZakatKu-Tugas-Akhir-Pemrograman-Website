<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use Carbon\Carbon;


class dashboardUser extends Controller
{
    public function index()
    {
        $tahunSekarang = Carbon::now()->year;

        $transaksis = TransaksiZakat::with(['user', 'jenis', 'bentuk', 'statusPembayaran', 'pembayaranZakat'])
            ->whereHas('statusPembayaran', fn($q) => $q->where('statusPembayaranId', 2))
            ->whereHas('pembayaranZakat', fn($q) => $q->where('tahun', $tahunSekarang))
            ->where('statusPembayaranId', 2)
            ->orderBy('tanggalTransaksi', 'desc') // <-- urutkan dari yang terbaru
            ->get();


        return view('dashboard', compact('transaksis'));
    }
}
