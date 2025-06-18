@extends('layouts.adminLayout')

@section('title', 'Data Pembagian Zakat')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-800 border-b-2 border-green-300 pb-2">
            Pembagian Zakat Tahun {{ $tahun->tahun }}
        </h1>
        <div class="flex gap-4">
            <a href="{{ route('penyaluran.create') }}"
            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded shadow">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </a>

            <a href="{{ route('admin.penyaluran.exportPdf', ['tahun' => $tahun->tahun]) }}"
            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded shadow">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>


    @if($penyalurans->isEmpty())
        <p class="text-gray-500 mt-10">Belum ada data pembagian untuk tahun ini.</p>
    @else
        <div class="space-y-4">
            @foreach($penyalurans as $data)
                @php
                    $statusClass = match($data->statusId) {
                        1 => 'bg-yellow-100 text-yellow-700',
                        2 => 'bg-green-100 text-green-700',
                        3 => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp

                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="space-y-1">
                        <p class="text-lg text-gray-800 font-semibold">
                            {{ $data->penerima->namaKepalaKeluarga ?? '-' }} — {{ $data->jenis->namaJenisZakat ?? 'Zakat' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            Disalurkan oleh: {{ $data->amil->name ?? '-' }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                            {{ $data->status->namaStatus ?? 'Pending' }}
                        </span>
                        <button onclick='showModal(@json($data))' class="text-green-600 hover:text-green-800">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg max-w-2xl mx-auto mt-20 p-6 relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-2xl font-bold">&times;</button>
        <h2 class="text-xl font-bold mb-4 text-green-700">Detail Pembagian Zakat</h2>
        <div id="modalContent" class="space-y-3 text-sm text-gray-700"></div>
    </div>
</div>

<script>
    function showModal(data) {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('modalContent');

        content.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                <div><span class="font-semibold">Nama Penerima:</span><br>${data.penerima?.namaKepalaKeluarga ?? '-'}</div>
                <div><span class="font-semibold">Jenis Zakat:</span><br>${data.jenis?.namaJenisZakat ?? '-'}</div>
                <div><span class="font-semibold">Status:</span><br>${data.status?.namaStatus ?? '-'}</div>
                <div><span class="font-semibold">Amil:</span><br>${data.amil?.name ?? '-'}</div>
            </div>
        `;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection
