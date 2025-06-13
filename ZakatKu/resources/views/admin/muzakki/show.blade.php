@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Muzakki</h2>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nama:</label>
            <p class="text-gray-900">{{ $muzakki->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Username:</label>
            <p class="text-gray-900">{{ $muzakki->username }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Email:</label>
            <p class="text-gray-900">{{ $muzakki->email }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Alamat:</label>
            <p class="text-gray-900">{{ $muzakki->alamat }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nomor Telepon:</label>
            <p class="text-gray-900">{{ $muzakki->nomorTelepon }}</p>
        </div>
    </div>

    <a href="{{ route('muzakki.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
        &larr; Kembali ke Data Muzakki
    </a>
</div>
@endsection
