@extends('layouts.userLayout')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-800 border-b-2 border-green-300 pb-2 w-full">
            Riwayat Pembayaran Zakat
        </h1>
    </div>

    @if($riwayat->isEmpty())
        <p class="text-gray-500 mt-10">Tidak ada riwayat pembayaran zakat ditemukan.</p>
    @else
        @foreach($riwayat as $item)
            <a href="{{ route('riwayat.redirect', $item->transaksiZakatId) }}"
            class="block p-6 mb-4 bg-white border border-green-200 rounded-lg shadow-sm hover:bg-green-50 transition duration-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0">
                    <!-- Info Transaksi -->
                    <div class="space-y-1">
                        <p class="text-lg text-gray-800 font-semibold">
                            {{ $item->jenis->namaJenisZakat ?? 'Zakat' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($item->tanggalTransaksi)->format('d M Y') }} •
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Status -->
                    @php
                        $statusId = $item->statusPembayaran->statusPembayaranId;
                        $statusLabel = $item->statusPembayaran->namaStatus ?? 'Status Tidak Diketahui';

                        $statusClass = match ($statusId) {
                            1 => 'bg-red-100 text-red-700',
                            2 => 'bg-green-100 text-green-700',
                            3 => 'bg-yellow-100 text-yellow-700',
                            4 => 'bg-orange-100 text-orange-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                    @endphp

                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>
            </a>
        @endforeach
    @endif
</div>
@endsection
