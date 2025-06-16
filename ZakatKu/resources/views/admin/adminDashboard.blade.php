@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Baris Atas -->
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Selamat Datang -->
        <div class="flex-1 bg-emerald-100 border border-emerald-300 rounded-xl p-6 bg-no-repeat bg-right"
             style="background-image: url('https://img.freepik.com/free-vector/ramadan-kareem-card-vector_53876-142566.jpg?t=st=1718540000~exp=1718543600~hmac=2e7cf843469d861af9f2dbf85001e1cb1358dc624caddba8f64b2e362a6c2584&w=996'); background-size: cover; background-position: right center;">
            <p class="text-3xl md:text-5xl text-emerald-900 leading-relaxed">
                Assalamu’alaikum<br>
                <strong>{{ Auth::user()->name }}</strong>
            </p>
            <span class="bg-emerald-400 text-white text-lg md:text-xl inline-block rounded-full mt-6 md:mt-12 px-6 py-2 shadow">
                <strong>{{ date('H:i') }} WIB</strong>
            </span>
        </div>

        <!-- Inbox -->
        <div class="flex-1 bg-yellow-100 border border-yellow-300 rounded-xl p-6 bg-no-repeat bg-right"
             style="background-image: url('https://img.freepik.com/free-vector/ramadan-kareem-card-vector_53876-142566.jpg?t=st=1718540000~exp=1718543600~hmac=2e7cf843469d861af9f2dbf85001e1cb1358dc624caddba8f64b2e362a6c2584&w=996'); background-size: cover; background-position: right center;">
            <p class="text-3xl md:text-5xl text-yellow-900 leading-relaxed">
                Pesan Baru<br><strong>23</strong>
            </p>
            <a href="#" class="bg-yellow-400 text-white text-lg md:text-xl underline hover:no-underline inline-block rounded-full mt-6 md:mt-12 px-6 py-2 shadow">
                <strong>Lihat Pesan</strong>
            </a>
        </div>
    </div>

    <!-- Baris Bawah -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Total Muzakki -->
        <div class="bg-white border border-green-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-green-800 mb-2">Total Muzakki</h2>
            <p class="text-4xl font-bold text-green-600">{{ $totalMuzakki }}</p>
        </div>

        <!-- Pembayaran Pending -->
        <div class="bg-white border border-yellow-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-800 mb-2">Pembayaran Pending</h2>
            <p class="text-4xl font-bold text-yellow-500">{{ $totalPending }}</p>
        </div>

        <!-- Pembayaran Tahun Ini -->
        <div class="bg-white border border-emerald-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-emerald-800 mb-2">Pembayaran Tahun Ini</h2>
            <p class="text-4xl font-bold text-emerald-600">{{ $totalTahunIni }}</p>
        </div>
    </div>
</div>
@endsection
