@extends('layouts.adminLayout') {{-- Ubah sesuai layout yang kamu gunakan --}}

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-bold text-green-800 mb-8 border-b-2 border-green-300 pb-2">
        Dashboard Admin
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Muzakki -->
        <div class="bg-white shadow-md border-l-4 border-green-500 rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-green-600 text-4xl mr-4">
                    <i class="fas fa-user-check"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-green-800">Total Muzakki</h2>
                    <p class="text-3xl font-bold text-green-700 mt-1">{{ $totalMuzakki }}</p>
                </div>
            </div>
        </div>

        <!-- Total Pending -->
        <div class="bg-white shadow-md border-l-4 border-yellow-400 rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-yellow-500 text-4xl mr-4">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-yellow-700">Pembayaran Pending</h2>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $totalPending }}</p>
                </div>
            </div>
        </div>

        <!-- Total Tahun Ini -->
        <div class="bg-white shadow-md border-l-4 border-emerald-500 rounded-lg p-6">
            <div class="flex items-center">
                <div class="text-emerald-600 text-4xl mr-4">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-emerald-800">Pembayaran Tahun Ini</h2>
                    <p class="text-3xl font-bold text-emerald-700 mt-1">{{ $totalTahunIni }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
