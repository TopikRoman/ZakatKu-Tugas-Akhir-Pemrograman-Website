@extends('layouts.loginLayout')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-green-100 via-green-200 to-yellow-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-lg shadow-lg">
        <!-- Logo -->
        <div class="text-center">
            <img src="{{ asset('storage/images/logo-zakat.png') }}" alt="Logo Zakat" class="h-20 mx-auto">
            <h2 class="mt-4 text-2xl font-bold text-green-700">Masuk ke Zakatku</h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full border border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-700">Ingat saya</span>
                </label>
            </div>

            <!-- Button + Register -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('register'))
                    <a class="underline text-sm text-green-600 hover:text-green-800" href="{{ route('register') }}">
                        Belum punya akun? Daftar
                    </a>
                @endif

                <x-primary-button class="bg-green-600 hover:bg-green-700 focus:ring-green-500">
                    {{ __('Masuk') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection
