@extends('layouts.userLayout')

@section('title', 'Detail Pembayaran Zakat')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 text-[15px]">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-emerald-300 pb-4">
        <div>
            <h1 class="text-3xl sm:text-4xl font-bold text-emerald-900 tracking-wide">ZakatKu</h1>
            <p class="text-sm text-emerald-600 italic mt-1">"Ambillah zakat dari sebagian harta mereka..." (QS. At-Taubah:103)</p>
        </div>
        <a href="{{ route('dashboard') }}"
           class="mt-4 sm:mt-0 bg-emerald-700 hover:bg-emerald-800 text-white px-5 py-2 rounded-lg shadow transition font-semibold">
            Kembali ke Dashboard
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8 border border-emerald-300 space-y-10">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Detail Transaksi --}}
            <div class="flex-1 space-y-6">
                <div>
                    <p class="uppercase text-xs text-gray-500 font-semibold tracking-wider mb-2">Rincian Pembayaran</p>
                    <h2 class="text-2xl font-bold text-emerald-800">Rp {{ number_format($respons['data']['amount_received'] ?? 0, 0, ',', '.') }}</h2>
                    <span class="inline-block mt-2 {{ $respons['data']['status'] === 'PAID' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }} text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                        {{ strtoupper($respons['data']['status'] ?? '-') }}
                    </span>
                </div>

                <div>
                    <p class="uppercase text-xs text-gray-500 font-semibold">Kode Referensi</p>
                    <p class="text-base text-gray-800 mt-1">{{ $respons['data']['reference'] ?? '-' }}</p>
                </div>

                {{-- Metode Pembayaran --}}
                <div>
                    <p class="uppercase text-xs text-gray-500 font-semibold">Metode / Kode Pembayaran</p>
                    @php $metode = strtoupper($respons['data']['payment_method'] ?? ''); @endphp

                    @if($metode === 'QRIS')
                        <div class="mt-3">
                            <img src="{{ $respons['data']['qr_url'] ?? '#' }}" alt="QR Code Pembayaran"
                                class="w-52 sm:w-60 rounded border border-green-200 shadow-md">
                            <p class="text-xs text-gray-500 mt-2 italic">Silakan scan QR code menggunakan aplikasi pembayaran.</p>
                        </div>
                    @elseif($metode === 'SHOPEEPAY')
                        <div class="mt-3">
                            <a href="{{ $respons['data']['pay_url'] ?? '#' }}" target="_blank"
                                class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md shadow transition">
                                Bayar Sekarang
                            </a>
                            <p class="text-xs text-gray-500 mt-2 italic">Klik tombol untuk membuka pembayaran di ShopeePay.</p>
                        </div>
                    @else
                        <p class="text-base text-gray-800 mt-1">{{ $respons['data']['pay_code'] ?? '-' }}</p>
                    @endif
                </div>

                {{-- Info Tambahan --}}
                @php
                    use Carbon\Carbon;
                    $expired = Carbon::createFromTimestamp($respons['data']['expired_time'] ?? time())->locale('id')->translatedFormat('d F Y, H:i');
                @endphp

                <div class="space-y-4 pt-2">
                    <div>
                        <p class="uppercase text-xs text-gray-500 font-semibold">Nama Pengguna</p>
                        <p class="text-base text-gray-800 mt-1">{{ $respons['data']['customer_name'] ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="uppercase text-xs text-gray-500 font-semibold">Batas Waktu Pembayaran</p>
                        <p class="text-base text-red-700 font-semibold mt-1">{{ $expired }} WIB</p>
                    </div>

                    <div>
                        <p class="uppercase text-xs text-gray-500 font-semibold">Biaya Tambahan</p>
                        <p class="text-base text-gray-800 mt-1">Rp {{ number_format($respons['data']['fee_customer'], 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="uppercase text-xs text-gray-500 font-semibold">Total yang Harus Dibayar</p>
                        <p class="text-base text-gray-800 mt-1">Rp {{ number_format($respons['data']['amount'], 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="uppercase text-xs text-gray-500 font-semibold">Tautan Cadangan</p>
                        <a href="{{ $respons['data']['checkout_url'] }}" target="_blank"
                            class="inline-block mt-1 text-blue-600 hover:underline text-sm">
                            Klik di sini jika QR tidak muncul
                        </a>
                    </div>
                </div>
            </div>

            {{-- Petunjuk Pembayaran --}}
            <div class="flex-1">
                <p class="uppercase text-xs text-gray-500 font-semibold tracking-wide mb-3">Petunjuk Pembayaran</p>
                @php $instructions = $respons['data']['instructions'] ?? []; @endphp

                @forelse ($instructions as $index => $item)
                    <div class="mb-4 border border-emerald-100 rounded-xl overflow-hidden">
                        <button onclick="toggleDropdown('inst-{{ $index }}')"
                            class="w-full flex justify-between items-center px-4 py-3 bg-emerald-50 text-emerald-800 font-semibold hover:bg-emerald-100 transition">
                            <span>{{ $item['title'] ?? 'Instruksi' }}</span>
                            <span id="arrow-inst-{{ $index }}" class="transform transition-transform">&#9662;</span>
                        </button>
                        <div id="dropdown-inst-{{ $index }}" class="hidden px-4 pb-4 text-sm text-gray-700 bg-white">
                            @if (!empty($item['steps']))
                                <ol class="list-decimal pl-5 space-y-1 mt-2">
                                    @foreach ($item['steps'] as $step)
                                        <li>{!! $step !!}</li>
                                    @endforeach
                                </ol>
                            @else
                                <p>Instruksi tidak tersedia.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Tidak ada instruksi tersedia.</p>
                @endforelse
            </div>
        </div>

        {{-- Form Upload Bukti --}}
        <div class="pt-6 border-t border-emerald-100">
            <h2 class="text-xl font-bold text-emerald-900 mb-3">Upload Bukti Pembayaran</h2>

            <form id="formBukti" action="{{ route('upload.bukti') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="reference" value="{{ $respons['data']['reference'] ?? '' }}">

                <div>
                    <label for="bukti" class="block text-sm font-medium text-gray-700 mb-1">Pilih File Bukti (jpg, png, pdf)</label>
                    <input type="file" name="bukti" id="bukti" accept=".jpg,.jpeg,.png,.pdf" required
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm
                        file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm
                        file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"/>
                    @error('bukti')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="button" onclick="konfirmasiUpload()"
                    class="bg-emerald-700 hover:bg-emerald-800 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif

{{-- Script --}}
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById('dropdown-' + id);
        const arrow = document.getElementById('arrow-' + id);
        dropdown.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

        // Intercept tombol back di browser
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.location.href = "{{ route('user.riwayat') }}";
    };

    function konfirmasiUpload() {
        Swal.fire({
            title: 'Yakin ingin mengirim bukti pembayaran?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formBukti').submit();
            }
        });
    }
</script>
@endsection
