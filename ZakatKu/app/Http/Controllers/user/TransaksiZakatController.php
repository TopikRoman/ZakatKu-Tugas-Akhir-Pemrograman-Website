<?php

namespace App\Http\Controllers\user;

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

use Illuminate\Support\Facades\Storage;

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
                'atasNama' => 'required|string|max:255',
                'pembayaranZakatId' => 'required|exists:pembayaran_zakat,pembayaranZakatId',
                'jenisId' => 'required|exists:jenis_zakat,jenisId',
                'bentukId' => 'required|exists:bentuk_zakat,bentukId',
                'jumlah' => 'required|numeric|min:0',
            ]);

            $transaksi = TransaksiZakat::create([
                'userId' => Auth::id(),
                'atasNama' => $request->atasNama,
                'pembayaranZakatId' => $request->pembayaranZakatId,
                'jenisId' => $request->jenisId,
                'bentukId' => $request->bentukId,
                'jumlah' => $request->jumlah,
                'tanggalTransaksi' => now(),
                'statusPembayaranId' => 4,
                'metodePembayaranId' => null,
                'noReferensi' => null,
            ]);

            if ($request->action === 'simpan') {
                return redirect()->route('transaksi-zakat.index')->with('success', 'Transaksi berhasil disimpan.');
            } elseif ($request->action === 'bayar') {
                return redirect()->route('zakat.pilihMetode', $transaksi->transaksiZakatId);
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function uploadBukti(Request $request)
    {
        $request->validate([
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'reference' => 'required|string'
        ]);

        try {
            $file = $request->file('bukti');
            $filename = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('bukti', $filename, 'public');

            $transaksi = TransaksiZakat::where('noReferensi', $request->reference)->first();

            if (!$transaksi) {
                return back()->with('error', 'Transaksi tidak ditemukan.');
            }

            // Simpan path gambar dan ubah status pembayaran jadi 3
            $transaksi->image = $path;
            $transaksi->statusPembayaranId = 3;
            $transaksi->save();

            return redirect()->route('user.riwayat')->with('success', 'Bukti pembayaran berhasil diunggah.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



}
