<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiZakat;
use App\Models\JenisZakat;

class TripayAPI extends Controller
{
    public function tripay(Request $request)
    {
        // dd($request->transaksiId);
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = 'ZKT-'.time();
        $metodeMap = [
            2 => 'BRIVA', // Bank BRI
            3 => 'QRIS',
            4 => 'BNIVA',
            5 => 'GOPAY',
            6 => 'SHOPEEPAY',
        ];
        $tripayMethod = $metodeMap[$request->metodePembayaranId] ?? null;

        if (!$tripayMethod) {
            return back()->with('error', 'Metode pembayaran tidak valid');
        }
        $transaksi = TransaksiZakat::with(['user', 'jenis', 'bentuk', 'pembayaranZakat'])->findOrFail($request->transaksiId);

        $amount = $transaksi->jumlah;
        $name = $transaksi->user->name;
        $email = $transaksi->user->email;
        $phone = $transaksi->user->nomorTelepon;
        $jenisZakat = $transaksi->jenis->namaJenisZakat;

        // dd($amount, $tripayMethod, $name, $email, $phone, $jenisZakat);

        $data = [
            'method'         => $tripayMethod,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $name,
            'customer_email' => $email,
            'customer_phone' => $phone,
            'order_items'    => [
                [
                    'name'        => $jenisZakat,
                    'price'       => $amount,
                    'quantity'    => 1,
                ],
            ],
            'return_url'   => 'https://domainanda.com/redirect',
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = json_decode(curl_exec($curl));
        $error = curl_error($curl);

        curl_close($curl);

        return $response ?: $err;
    }
}
