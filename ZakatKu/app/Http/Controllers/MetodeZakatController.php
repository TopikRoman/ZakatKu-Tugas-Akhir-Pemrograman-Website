<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use Illuminate\Support\Facades\Auth;
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
}
