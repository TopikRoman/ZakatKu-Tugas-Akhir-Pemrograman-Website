<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-green-800 leading-tight border-b border-green-300 pb-2">
            {{ __('Profil Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-green-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Informasi Profil --}}
            <div class="bg-white border border-green-200 shadow-md rounded-xl p-6">
                <h3 class="text-lg font-bold text-green-700 mb-4">Informasi Akun</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Ubah Password --}}
            <div class="bg-white border border-green-200 shadow-md rounded-xl p-6">
                <h3 class="text-lg font-bold text-green-700 mb-4">Ubah Kata Sandi</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Hapus Akun --}}
            <div class="bg-white border border-red-200 shadow-md rounded-xl p-6">
                <h3 class="text-lg font-bold text-red-600 mb-4">Hapus Akun</h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
