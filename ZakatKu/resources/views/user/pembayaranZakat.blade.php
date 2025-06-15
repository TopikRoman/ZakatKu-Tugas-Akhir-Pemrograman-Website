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

        <!-- Atas Nama -->
        <div class="mb-4">
            <label for="atasNama" class="block text-green-800 font-semibold mb-1">Atas Nama</label>
            <input type="text" name="atasNama" id="atasNama" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Masukkan nama orang yang diwakilkan" required>
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

            <input type="text" value="Uang" disabled class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 text-gray-800">
            <input type="hidden" name="bentukId" value="1">
        </div>


        <!-- Jumlah -->
        <div class="mb-4">
            <label for="jumlah" class="block text-green-800 font-semibold mb-1">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Masukkan jumlah zakat" required>
        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" name="action" value="simpan"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Simpan
            </button>
            <button type="submit" name="action" value="bayar"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                Bayar Sekarang
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
