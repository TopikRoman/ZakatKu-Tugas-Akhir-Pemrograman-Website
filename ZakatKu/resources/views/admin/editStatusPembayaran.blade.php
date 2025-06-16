@extends('layouts.adminLayout') {{-- Ganti sesuai layout adminmu --}}

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-2xl font-bold text-emerald-800 mb-6">Verifikasi Pembayaran Zakat</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 space-y-6 border border-emerald-200">
        {{-- Informasi Transaksi --}}
        <div>
            <p class="text-sm text-gray-600 font-semibold">Nama Pengguna:</p>
            <p class="text-lg font-bold text-emerald-700">{{ $transaksi->user->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600 font-semibold">Jumlah Zakat:</p>
            <p class="text-lg text-gray-800">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600 font-semibold">Atas Nama:</p>
            <p class="text-base text-gray-800">{{ $transaksi->atasNama }}</p>
        </div>

        {{-- Gambar Bukti Pembayaran --}}
        <div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Bukti Pembayaran:</p>
            @if($transaksi->image)
                <img src="{{ asset('storage/' . $transaksi->image) }}"
                     alt="Bukti Pembayaran"
                     class="w-full max-w-md rounded border border-gray-300 shadow-sm">
            @else
                <p class="text-sm text-red-500 italic">Belum ada bukti pembayaran diunggah.</p>
            @endif
        </div>

        {{-- Form Update Status --}}
        <form action="{{ route('admin.zakat.updateStatus', $transaksi->transaksiZakatId) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran:</label>
                <select name="statusPembayaranId" id="status" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" {{ $transaksi->statusPembayaranId == 1 ? 'selected' : '' }}>Belum Dibayar</option>
                    <option value="2" {{ $transaksi->statusPembayaranId == 2 ? 'selected' : '' }}>Sudah Dibayar</option>
                    <option value="3" {{ $transaksi->statusPembayaranId == 3 ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                </select>
            </div>

            <button type="submit"
                class="bg-emerald-700 hover:bg-emerald-800 text-white px-6 py-2 rounded-lg shadow">
                Perbarui Status
            </button>
        </form>
    </div>
</div>
@endsection
