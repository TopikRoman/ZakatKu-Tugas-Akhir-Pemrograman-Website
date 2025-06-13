@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Amil</h2>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nama:</label>
            <p class="text-gray-900">{{ $amil->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Username:</label>
            <p class="text-gray-900">{{ $amil->username }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Email:</label>
            <p class="text-gray-900">{{ $amil->email }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Alamat:</label>
            <p class="text-gray-900">{{ $amil->alamat }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Nomor Telepon:</label>
            <p class="text-gray-900">{{ $amil->nomorTelepon }}</p>
        </div>
    </div>

    <a href="{{ route('amil.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
        &larr; Kembali ke Data Amil
    </a>
</div>
@endsection
