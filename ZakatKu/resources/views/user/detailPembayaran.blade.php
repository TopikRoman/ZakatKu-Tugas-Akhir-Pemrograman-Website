@extends('layouts.userLayout')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6">
    <div class="flex justify-between items-start mb-10">
        <h1 class="text-3xl font-bold text-green-800">ZakatKu</h1>
        <a href="{{ route('dashboard') }}"
           class="bg-green-800 hover:bg-green-900 text-white px-4 py-2 rounded-lg shadow transition">
            Dashboard
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-8 border border-green-200">
        <div class="flex flex-col lg:flex-row justify-between gap-8">
            {{-- Kiri: Detail Transaksi --}}
        <div class="flex-1">
            <p class="uppercase text-xs text-gray-500 font-semibold tracking-wide">Transaction Detail</p>

            {{-- Jumlah yang diterima --}}
            <h2 class="text-3xl font-bold text-gray-800 mt-2">
                Rp {{ number_format($respons['data']['amount_received'] ?? 0, 0, ',', '.') }}
            </h2>

            {{-- Status Pembayaran --}}
            <span class="inline-block mt-2
                {{ $respons['data']['status'] === 'PAID' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}
                text-xs font-semibold px-3 py-1 rounded-full">
                {{ strtoupper($respons['data']['status'] ?? '-') }}
            </span>

            {{-- Kode Transaksi --}}
            <div class="mt-6">
                <p class="uppercase text-xs text-gray-500 font-semibold tracking-wide">Kode Referensi</p>
                <p class="text-sm text-gray-700 mt-1">{{ $respons['data']['reference'] ?? '-' }}</p>
            </div>

            {{-- Nomor Referensi (merchant_ref) --}}
            <div class="mt-4">
                <p class="uppercase text-xs text-gray-500 font-semibold tracking-wide">Kode Pembayaran</p>

                @php
                    $metode = strtoupper($respons['data']['payment_method'] ?? '');
                @endphp

                @if($metode === 'QRIS')
                    {{-- Jika metode QRIS, tampilkan QR Code --}}
                    <div class="mt-2">
                        <img src="{{ $respons['data']['qr_url'] ?? '#' }}" alt="QR Code Pembayaran" class="w-60 rounded border border-gray-300 shadow-md">
                        <p class="text-xs text-gray-500 mt-2">Silakan scan QR code menggunakan aplikasi pembayaran Anda.</p>
                    </div>

                @elseif($metode === 'SHOPEEPAY')
                    {{-- Jika metode ShopeePay, tampilkan tombol bayar dengan pay_url --}}
                    <div class="mt-2">
                        <a href="{{ $respons['data']['pay_url'] ?? '#' }}"
                        target="_blank"
                        class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md shadow transition">
                            Bayar Sekarang
                        </a>
                        <p class="text-xs text-gray-500 mt-2">Klik tombol untuk membuka pembayaran di ShopeePay.</p>
                    </div>

                @else
                    {{-- Selain QRIS dan ShopeePay, tampilkan kode bayar --}}
                    <p class="text-sm text-gray-700 mt-1">{{ $respons['data']['pay_code'] ?? '-' }}</p>
                @endif
            </div>


        </div>

            {{-- Kanan: Dropdown Instruksi --}}
            <div class="flex-1">
                <p class="uppercase text-xs text-gray-500 font-semibold tracking-wide mb-3">Instruksi Pembayaran</p>

                {{-- Internet Banking --}}
                <div class="mb-4 border border-gray-200 rounded-lg">
                    <button onclick="toggleDropdown('ib')" class="w-full flex justify-between items-center px-4 py-3 text-left text-green-800 font-medium hover:bg-green-50 transition">
                        <span>Internet Banking</span>
                        <span id="arrow-ib" class="transform transition-transform">&#9662;</span>
                    </button>
                    <div id="dropdown-ib" class="hidden px-4 pb-4 text-sm text-gray-700">
                        Silakan transfer ke:<br>
                        Bank BRI a.n. Panitia Zakat<br>
                        Rek: 1234-5678-9012<br>
                        Gunakan kode transaksi sebagai berita.
                    </div>
                </div>

                {{-- ATM --}}
                <div class="border border-gray-200 rounded-lg">
                    <button onclick="toggleDropdown('atm')" class="w-full flex justify-between items-center px-4 py-3 text-left text-green-800 font-medium hover:bg-green-50 transition">
                        <span>ATM</span>
                        <span id="arrow-atm" class="transform transition-transform">&#9662;</span>
                    </button>
                    <div id="dropdown-atm" class="hidden px-4 pb-4 text-sm text-gray-700">
                        Pilih menu Transfer > Bank Lain > Masukkan nomor rekening:<br>
                        1234-5678-9012 (BRI)<br>
                        Konfirmasi nama dan jumlah zakat Anda.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript --}}
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById('dropdown-' + id);
        const arrow = document.getElementById('arrow-' + id);

        dropdown.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
@endsection
