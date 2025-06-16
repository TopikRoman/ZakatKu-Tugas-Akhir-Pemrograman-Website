<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use App\Models\User;
use App\Models\JenisZakat;
use App\Models\BentukZakat;
use App\Models\PembayaranZakat;
use App\Models\StatusPembayaran;
use Illuminate\Support\Facades\Storage;

class AdminTransaksiZakatController extends Controller
{
    public function create()
    {
        return view('admin.tambahTransaksiAdmin', [
            'user' => auth()->user(),
            'jenisZakat' => JenisZakat::all(),
            'bentukZakat' => BentukZakat::all(),
            'pembayaranZakat' => PembayaranZakat::all(),
            'status' => StatusPembayaran::all()
        ]);
    }

    public function store(Request $request)
    {
        // Paksa ambil data dari user yang sedang login
        $request->merge([
            'userId' => auth()->id(),
            'tanggalTransaksi' => now(),
            'statusPembayaranId' => 2, // status default = "diproses" / tertunda
            'noReferensi' => 'Admin-' . time(),
        ]);

        $validated = $request->validate([
            'userId' => 'required|exists:users,id',
            'pembayaranZakatId' => 'required|exists:pembayaran_zakat,pembayaranZakatId',
            'jenisId' => 'required|exists:jenis_zakat,jenisId',
            'bentukId' => 'required|exists:bentuk_zakat,bentukId',
            'jumlah' => 'required|numeric|min:1',
            'tanggalTransaksi' => 'required|date',
            'statusPembayaranId' => 'required|exists:status_pembayaran,statusPembayaranId',
            'atasNama' => 'nullable|string|max:255',
            'noReferensi' => 'required|string|max:100',
        ]);

        TransaksiZakat::create($validated);

        return redirect()->route('transaksi.create')->with('success', 'Transaksi berhasil ditambahkan.');
    }

}
