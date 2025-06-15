<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\TripayAPI;
use Carbon\Carbon;

class MetodeZakatController extends Controller
{

    public function pilihMetode($id)
    {
        // Simpan id transaksi ke dalam variabel
        $idTransaksi = $id;

        // Kirim ke view
        return view('user.pilihMetode', compact('idTransaksi'));
    }

    public function metodeStore(REQUEST $request)
    {
        $tripay = new TripayAPI();
        $respons = $tripay->tripay($request);

        return view('user.detailPembayaran', compact('respons'));

    }
}
