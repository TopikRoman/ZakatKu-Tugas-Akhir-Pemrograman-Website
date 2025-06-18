@extends('layouts.adminLayout')

@section('title', 'Tambah Transaksi Zakat')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-xl p-8 border border-green-200">
    <h1 class="text-3xl font-bold text-green-800 mb-8 border-b pb-3">Tambah Transaksi Zakat</h1>

    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama Pengguna -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Pengguna</label>
            <input type="hidden" name="userId" value="{{ $user->id }}">
            <input type="text" class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-800" value="{{ $user->name }}" readonly>
        </div>

        <!-- Tahun Pembayaran -->
        <div>
            <label for="pembayaranZakatId" class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pembayaran</label>
            <select name="pembayaranZakatId" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white">
                <option value="">-- Pilih Tahun --</option>
                @foreach($pembayaranZakat as $p)
                    <option value="{{ $p->pembayaranZakatId }}">{{ $p->tahun }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jenis Zakat -->
        <div>
            <label for="jenisId" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Zakat</label>
            <select name="jenisId" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white">
                <option value="">-- Pilih Jenis --</option>
                @foreach($jenisZakat as $jenis)
                    <option value="{{ $jenis->jenisId }}">{{ $jenis->namaJenisZakat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bentuk Zakat -->
        <div>
            <label for="bentukId" class="block text-sm font-semibold text-gray-700 mb-1">Bentuk Zakat</label>
            <select name="bentukId" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white">
                <option value="">-- Pilih Bentuk --</option>
                @foreach($bentukZakat as $bentuk)
                    <option value="{{ $bentuk->bentukId }}">{{ $bentuk->namaBentukZakat }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jumlah -->
        <div>
            <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-1">Jumlah</label>
            <input type="number" name="jumlah" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800" placeholder="Contoh: 100000">
        </div>

        <!-- Atas Nama -->
        <div>
            <label for="atasNama" class="block text-sm font-semibold text-gray-700 mb-1">Atas Nama</label>
            <input type="text" name="atasNama" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800" placeholder="Contoh: Budi Santoso">
        </div>

        <!-- Tombol Submit -->
        <div class="text-right">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#10B981',
        });
    </script>
@endif
@endsection
