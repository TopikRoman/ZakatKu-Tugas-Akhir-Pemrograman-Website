<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\TripayAPI;
use Carbon\Carbon;
use Illuminate\View\View;

class MetodeZakatController extends Controller
{

    public function pilihMetode($id)
    {
        // Simpan id transaksi ke dalam variabel
        $idTransaksi = $id;

        // Kirim ke view
        return view('user.pilihMetode', compact('idTransaksi'));
    }

    public function metodeStore(Request $request)
    {
        $tripay = new TripayAPI();
        $respons = $tripay->requestPayment($request);

        // Ambil noReferensi dari respons API Tripay
        $noReferensi = $respons['data']['reference'] ?? null;

        if (!$noReferensi) {
            return back()->with('error', 'Gagal mendapatkan no referensi dari Tripay');
        }

        // Simpan response ke session agar tidak perlu request ulang di detailShow
        session(["tripay_response_$noReferensi" => $respons]);

        // Redirect ke detailShow route
        return redirect()->route('zakat.detailShow', ['noReferensi' => $noReferensi]);
    }

    public function detailShow(Request $request, $noReferensi)
    {

        $tripay = new TripayAPI();
        $respons = $tripay->detailPayment($noReferensi);

        return $this->renderDetailPembayaran($respons);
    }


    private function renderDetailPembayaran(array $respons): View
    {
        return view('user.detailPembayaran', compact('respons'));
    }

}
