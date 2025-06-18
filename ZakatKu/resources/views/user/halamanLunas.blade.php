@extends('layouts.userLayout')

@section('title', 'Pembayaran Zakat - Selesai')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white shadow-lg rounded-xl p-8 border border-green-300">
    <h2 class="text-2xl font-bold text-green-800 mb-6 border-b border-green-300 pb-2">
        Detail Transaksi - Selesai
    </h2>

    <div class="space-y-4 text-gray-700 text-base">
        <div class="flex justify-between">
            <span class="font-semibold">Nama</span>
            <span>{{ $riwayat->user->name }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Jenis Zakat</span>
            <span>{{ $riwayat->jenis->namaJenisZakat }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Bentuk Zakat</span>
            <span>{{ $riwayat->bentuk->namaBentukZakat ?? '-' }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Jumlah</span>
            <span>Rp {{ number_format($riwayat->jumlah, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Tanggal Transaksi</span>
            <span>{{ \Carbon\Carbon::parse($riwayat->tanggalTransaksi)->format('d M Y') }}</span>
        </div>
    </div>

    <div class="mt-8 text-center bg-green-50 border border-green-200 text-green-700 font-semibold rounded-md p-4">
        Pembayaran telah berhasil. Terima kasih atas zakat Anda.
    </div>
</div>
@endsection
