<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\PembayaranZakat;
use App\Models\JenisZakat;
use App\Models\BentukZakat;
use App\Models\StatusPembayaran;
use App\Models\MetodePembayaran;
use App\Models\TransaksiZakat;

class TransaksiZakatController extends Controller
{
    public function index()
    {
        return view('user.pembayaranZakat', [
            'users' => User::all(),
            'pembayaranZakat' => PembayaranZakat::all(),
            'jenisZakat' => JenisZakat::all(),
            'bentukZakat' => BentukZakat::all(),
            // 'statusPembayaran' => StatusPembayaran::all(),
            'metodePembayaran' => MetodePembayaran::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pembayaranZakatId' => 'required|exists:pembayaran_zakat,pembayaranZakatId',
                'jenisId' => 'required|exists:jenis_zakat,jenisId',
                'bentukId' => 'required|exists:bentuk_zakat,bentukId',
                'jumlah' => 'required|numeric|min:0',
            ]);

            TransaksiZakat::create([
                'userId' => Auth::id(),
                'pembayaranZakatId' => $request->pembayaranZakatId,
                'jenisId' => $request->jenisId,
                'bentukId' => $request->bentukId,
                'jumlah' => $request->jumlah,
                'tanggalTransaksi' => $request->tanggalTransaksi ?? now(),
                'statusPembayaranId' => 1,
                'metodePembayaranId' => $request->metodePembayaranId ?? null,
            ]);

            return redirect()->route('transaksi-zakat.index')->with('success', 'Transaksi zakat berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

}
