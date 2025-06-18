@extends('layouts.userLayout')

@section('title', 'Pembayaran Zakat - Menunggu Konfirmasi')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-white shadow-lg rounded-xl p-8 border border-yellow-300">
    <h2 class="text-2xl font-bold text-yellow-800 mb-6 border-b border-yellow-300 pb-2">
        Detail Pembayaran - Menunggu Konfirmasi
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

    <div class="mt-8 text-yellow-700 font-semibold text-center bg-yellow-50 border border-yellow-200 rounded-md p-4">
        Mohon tunggu konfirmasi dari admin.
    </div>
</div>
@endsection
