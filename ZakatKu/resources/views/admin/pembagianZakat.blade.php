@extends('layouts.adminLayout') {{-- layout utama dengan navbarAdmin --}}

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6 flex-wrap gap-2">
        <h1 class="text-3xl md:text-4xl font-bold text-green-800 border-b-2 border-green-300 pb-2">
            Pembagian Zakat per Tahun
        </h1>

        <!-- Tombol Tambah Tahun -->
        <button id="tambah-tahun" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow flex items-center gap-2">
            <i class="fas fa-plus-circle"></i>
            <span class="hidden md:inline">Tambah Tahun {{ now()->year }}</span>
        </button>

        <!-- Hidden Form -->
        <form id="form-tambah-tahun" action="{{ route('tambahTahunIni') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($pembagianList as $item)
            <a href="{{ route('admin.pembagianZakat.show', ['id' => $item->pembagianId]) }}" class="block bg-white shadow-lg border-l-4 border-green-500 rounded-lg p-6 hover:bg-green-50 transition">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-green-800">Tahun {{ $item->tahun }}</h2>
                    <i class="fas fa-hand-holding-heart fa-2x text-green-600"></i>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Total Penyaluran:</span>
                        <span class="font-bold text-green-700">{{ $item->penyaluran_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Total Penerima:</span>
                        <span class="font-bold text-blue-700">{{ $item->jumlah_penerima }}</span>
                    </div>
                </div>
            </a>
        @empty
            <p class="col-span-3 text-center text-gray-500 mt-10">Belum ada data pembagian zakat tersedia.</p>
        @endforelse
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#16a34a'
        });
    </script>
    @endif

    @if(session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: '{{ session('info') }}',
            confirmButtonColor: '#3b82f6'
        });
    </script>
    @endif
</div>

<script>
    document.getElementById('tambah-tahun').addEventListener('click', function () {
        Swal.fire({
            title: 'Tambah Tahun {{ now()->year }}?',
            text: "Data pembagian zakat untuk tahun ini akan dibuat.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-tambah-tahun').submit();
            }
        });
    });
</script>
@endsection
