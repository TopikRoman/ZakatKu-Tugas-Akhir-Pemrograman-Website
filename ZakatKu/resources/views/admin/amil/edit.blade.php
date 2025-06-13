@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Amil</h2>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('amil.update', $amil->id) }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700">Nama:</label>
            <input type="text" name="name" value="{{ $amil->name }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Username:</label>
            <input type="text" name="username" value="{{ $amil->username }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Email:</label>
            <input type="email" name="email" value="{{ $amil->email }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Alamat:</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2" required>{{ $amil->alamat }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700">Nomor Telepon:</label>
            <input type="text" name="nomorTelepon" value="{{ $amil->nomorTelepon }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-gray-700">Password (kosongkan jika tidak diubah):</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
        </div>

        <input type="hidden" name="roleId" value="1">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Update
        </button>
    </form>
</div>
@endsection
