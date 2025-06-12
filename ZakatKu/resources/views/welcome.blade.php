@extends('layouts.guestLayout')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl md:text-3xl font-bold text-green-700 mb-4">Selamat Datang di Zakatku</h1>

    <p class="text-gray-700 mb-4">
        Zakatku adalah platform digital yang memudahkan Anda untuk menunaikan kewajiban zakat dengan aman, cepat, dan transparan.
    </p>

    <div class="grid md:grid-cols-2 gap-6 mt-6">
        <div class="border p-4 rounded-lg hover:shadow transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Pembayaran Zakat Online</h2>
            <p class="text-gray-600">Layanan pembayaran zakat secara daring untuk memudahkan muzakki tanpa harus datang langsung.</p>
        </div>

        <div class="border p-4 rounded-lg hover:shadow transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Riwayat dan Laporan</h2>
            <p class="text-gray-600">Catatan dan laporan pembayaran zakat yang tersimpan aman dan dapat diakses kapan saja.</p>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('login') }}"
            class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-md text-lg transition">
            Masuk untuk Melanjutkan
        </a>
    </div>
</div>

@endsection
