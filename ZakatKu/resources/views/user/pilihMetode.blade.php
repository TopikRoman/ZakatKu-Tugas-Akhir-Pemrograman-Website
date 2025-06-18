@extends('layouts.userLayout')

@section('content')
@php
    $metode = [
        ['id' => 2, 'nama' => 'Bank BRI', 'gambar' => 'bri.png'],
        ['id' => 3, 'nama' => 'QRIS', 'gambar' => 'qris.png'],
        ['id' => 4, 'nama' => 'Bank BNI', 'gambar' => 'bni.png'],
        ['id' => 6, 'nama' => 'SHOPEEPAY', 'gambar' => 'shopeepay.png'],
    ];
@endphp

<div class="max-w-6xl mx-auto mt-12 px-4">
    <h2 class="text-3xl font-bold text-green-800 mb-10 text-center border-b-2 border-green-300 pb-4">
        Pilih Metode Pembayaran Zakat Anda
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($metode as $item)
        <form action="{{ route('zakat.simpanMetode') }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-green-100 rounded-2xl shadow-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition duration-300">
        @csrf
        <input type='hidden' name=' transaksiId' value='{{ $idTransaksi }}'>
        <input type="hidden" name="metodePembayaranId" value="{{ $item['id'] }}">

        <div class="w-32 h-32 mb-5 flex items-center justify-center bg-green-50 rounded-xl shadow-inner">
            <img src="{{ asset('images/' . $item['gambar']) }}"
            alt="{{ $item['nama'] }}"
            class="object-contain w-full h-full p-2">
        </div>

                <p class="text-green-700 font-semibold text-lg mb-4 tracking-wide">
                    {{ $item['nama'] }}
                </p>

                <button type="submit"
                        class="mt-auto bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
                    Pilih
                </button>
            </form>
        @endforeach
    </div>
</div>
@endsection
