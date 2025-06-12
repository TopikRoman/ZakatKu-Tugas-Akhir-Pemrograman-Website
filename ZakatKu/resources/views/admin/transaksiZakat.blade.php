@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-800 border-b-2 border-green-300 pb-2">
            Transaksi Zakat Tahun {{ $tahun->tahun }}
        </h1>
        <a href="#" class="text-green-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($transaksis->isEmpty())
        <p class="text-gray-500 mt-10">Belum ada transaksi untuk tahun ini.</p>
    @else
        <div class="space-y-4">
            @foreach($transaksis as $trx)
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <!-- Info Transaksi -->
                    <div class="space-y-1">
                        <p class="text-lg text-gray-800 font-semibold">
                            {{ $trx->user->name }} — {{ $trx->jenis->nama ?? 'Zakat' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($trx->tanggalTransaksi)->format('d M Y') }} • Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                        </p>
                    </div>
                    <!-- Status dan Aksi -->
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($trx->statusPembayaranId == 3) bg-yellow-100 text-yellow-700
                            @elseif($trx->statusPembayaranId == 1) bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $trx->statusPembayaran->namaStatus ?? 'Pending' }}
                        </span>
                        <a href="#"
                           class="text-green-600 hover:text-green-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
