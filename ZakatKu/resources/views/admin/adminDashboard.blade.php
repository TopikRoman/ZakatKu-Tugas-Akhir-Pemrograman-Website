@extends('layouts.adminLayout')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Baris Atas -->
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Selamat Datang -->
        <div class="flex-1 bg-gradient-to-r from-green-200 via-green-100 to-yellow-100 border border-green-300 rounded-xl p-6 shadow">
            <p class="text-3xl md:text-5xl text-emerald-900 leading-relaxed">
                Assalamu’alaikum<br>
                <strong>{{ Auth::user()->name }}</strong>
            </p>
            <span class="bg-emerald-500 text-white text-lg md:text-xl inline-block rounded-full mt-6 md:mt-12 px-6 py-2 shadow">
                <strong>{{ date('H:i') }} WIB</strong>
            </span>
        </div>

        <!-- Pembayaran Pending -->
        <div class="flex-1 bg-gradient-to-l from-yellow-200 via-yellow-100 to-green-100 border border-yellow-300 rounded-xl p-6 shadow">
            <p class="text-3xl md:text-5xl text-yellow-900 leading-relaxed">
                Pembayaran<br><strong>Pending</strong>
            </p>
            <span class="bg-yellow-500 text-white text-lg md:text-xl inline-block rounded-full mt-6 md:mt-12 px-6 py-2 shadow">
                <strong>{{ $totalPending }}</strong>
            </span>
        </div>
    </div>

    <!-- Baris Bawah -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Total Muzakki -->
        <div class="bg-white border border-green-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-green-800 mb-2">Total Muzakki</h2>
            <p class="text-4xl font-bold text-green-600">{{ $totalMuzakki }}</p>
        </div>

        <!-- Total Pembagian Tahun Ini -->
        <div class="bg-white border border-yellow-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-800 mb-2">Total Pembagian Tahun Ini</h2>
            <p class="text-4xl font-bold text-yellow-500">{{ $totalPembagianTahunIni }}</p>
        </div>

        <!-- Pembayaran Tahun Ini -->
        <div class="bg-white border border-emerald-200 rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-emerald-800 mb-2">Pembayaran Tahun Ini</h2>
            <p class="text-4xl font-bold text-emerald-600">{{ $totalTahunIni }}</p>
        </div>
    </div>
</div>
@endsection
