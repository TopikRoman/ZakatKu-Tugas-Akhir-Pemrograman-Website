@extends('layouts.userLayout')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10 border border-green-200">
    <h2 class="text-2xl font-bold text-green-800 mb-6">Tambah Pembayaran Zakat</h2>

    <form action="{{ route('transaksi-zakat.store') }}" method="POST">
        @csrf

        <!-- User -->
        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">

        <!-- Menampilkan nama muzakki sebagai informasi -->
        <div class="mb-4">
            <label class="block text-green-800 font-semibold mb-1">Nama Muzakki</label>
            <div class="bg-gray-100 border border-gray-300 rounded-md px-3 py-2">
                {{ Auth::user()->name }}
            </div>
        </div>

        <!-- Pembayaran Zakat -->
        <div class="mb-4">
            <label for="pembayaranZakatId" class="block text-green-800 font-semibold mb-1">Tahun Pembayaran</label>
            <select name="pembayaranZakatId" id="pembayaranZakatId" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @foreach($pembayaranZakat as $item)
                    <option value="{{ $item->pembayaranZakatId }}">{{ $item->tahun }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Zakat -->
        <div class="mb-4">
            <label for="jenisId" class="block text-green-800 font-semibold mb-1">Jenis Zakat</label>
            <select name="jenisId" id="jenisId" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @foreach($jenisZakat as $jenis)
                    <option value="{{ $jenis->jenisId }}">{{ $jenis->namaJenisZakat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bentuk Zakat -->
        <div class="mb-4">
            <label for="bentukId" class="block text-green-800 font-semibold mb-1">Bentuk Zakat</label>
            <select name="bentukId" id="bentukId" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @foreach($bentukZakat as $bentuk)
                    <option value="{{ $bentuk->bentukId }}">{{ $bentuk->namaBentukZakat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jumlah -->
        <div class="mb-4">
            <label for="jumlah" class="block text-green-800 font-semibold mb-1">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Masukkan jumlah zakat" required>
        </div>

        <!-- Tanggal Transaksi -->
        {{-- <div class="mb-4">
            <label for="tanggalTransaksi" class="block text-green-800 font-semibold mb-1">Tanggal Transaksi</label>
            <input type="date" name="tanggalTransaksi" id="tanggalTransaksi" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div> --}}

        <!-- Status Pembayaran -->
        {{-- <div class="mb-4">
            <label for="statusPembayaranId" class="block text-green-800 font-semibold mb-1">Status Pembayaran</label>
            <select name="statusPembayaranId" id="statusPembayaranId" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @foreach($statusPembayaran as $status)
                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
        </div> --}}

        <!-- Metode Pembayaran -->
        {{-- <div class="mb-6">
            <label for="metodePembayaranId" class="block text-green-800 font-semibold mb-1">Metode Pembayaran</label>
            <select name="metodePembayaranId" id="metodePembayaranId" class="w-full border border-gray-300 rounded-md px-3 py-2">
                @foreach($metodePembayaran as $metode)
                    <option value="{{ $metode->id }}">{{ $metode->nama_metode }}</option>
                @endforeach
            </select>
        </div> --}}

        <!-- Tombol -->
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Simpan
            </button>
        </div>
    </form>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#10B981' // Tailwind green-500
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#EF4444' // Tailwind red-500
            });
        </script>
    @endif

</div>
@endsection
