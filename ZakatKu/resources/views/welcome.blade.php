@extends('layouts.guestLayout')

@section('content')

<section class="bg-white dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-tight tracking-tight text-green-800 md:text-5xl xl:text-6xl dark:text-white">
                Ayo Tunaikan <br><span class="text-green-600">Zakatmu</span> Bersama Zakatku
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-600 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-300">
                Platform zakat digital terpercaya dan mudah digunakan untuk menyalurkan kebaikan kepada yang membutuhkan, dikelola dengan transparan dan amanah.
            </p>
            <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <a href="#"
                   class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-white bg-green-700 hover:bg-green-800 rounded-lg shadow transition">
                    <i class="fas fa-hand-holding-heart mr-2"></i> Bayar Zakat Sekarang
                </a>
                <a href="#"
                   class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-green-700 border border-green-600 rounded-lg hover:bg-green-100 dark:border-green-400 dark:text-white dark:hover:bg-green-700 transition">
                    <i class="fas fa-info-circle mr-2"></i> Tentang Zakatku
                </a>
            </div>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="{{ asset('images/logo-zakat.png') }}" alt="Logo Zakatku" class="w-full h-auto max-w-md">
        </div>
    </div>
</section>


@endsection
