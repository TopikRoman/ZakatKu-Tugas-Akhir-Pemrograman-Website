@extends('layouts.loginLayout')

@section('title', 'Daftar Zakatku')

@section('content')
<div class="flex flex-wrap w-full min-h-screen bg-gradient-to-br from-green-100 via-green-200 to-yellow-100">
    <div class="flex flex-1 bg-white shadow-lg rounded-lg overflow-hidden m-4 md:m-20">
        <!-- Form Register -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf

                <!-- Logo -->
                <div class="text-center mb-6">
                    <img src="{{ asset('images\logo-zakat.png') }}" alt="Logo Zakat" class="h-20 mx-auto">
                    <h2 class="mt-4 text-2xl font-bold text-green-700">Daftar Akun Zakatku</h2>
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div class="mt-4">
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="text" name="username" :value="old('username')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Alamat -->
                <div class="mt-4">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <x-text-input id="alamat" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="text" name="alamat" :value="old('alamat')" required autocomplete="street-address" />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <!-- Nomor Telepon -->
                <div class="mt-4">
                    <x-input-label for="nomorTelepon" :value="__('Nomor Telepon')" />
                    <x-text-input id="nomorTelepon" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="text" name="nomorTelepon" :value="old('nomorTelepon')" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('nomorTelepon')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full border border-green-300 rounded-md shadow-sm"
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Aksi -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-green-700 hover:underline" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- Ilustrasi -->
        <div class="hidden md:block md:w-1/2 bg-cover bg-center rounded-r-lg"
             style="background-image: url('{{ asset('/images/bg-login.jpg') }}'); min-height: 400px;">
        </div>
    </div>
</div>
@endsection
