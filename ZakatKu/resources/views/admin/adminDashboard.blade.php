@extends('layouts.adminLayout') {{-- Ubah sesuai layout yang kamu gunakan --}}

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold">Total Users</h2>
            <p class="text-3xl mt-2 text-blue-600"></p>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold">Total Roles</h2>
            <p class="text-3xl mt-2 text-green-600"></p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('logout') }}" class="text-red-500 hover:underline">Logout</a>
    </div>
</div>
@endsection
