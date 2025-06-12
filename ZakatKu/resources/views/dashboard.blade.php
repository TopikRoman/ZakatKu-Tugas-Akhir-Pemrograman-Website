@extends('layouts.userLayout')

@section('title', 'Beranda')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-600">Ini adalah halaman dashboard Anda.</p>
@endsection

