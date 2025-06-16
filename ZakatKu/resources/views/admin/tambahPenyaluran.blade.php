@extends('layouts.adminLayout')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-green-800 mb-6">Tambah Data Penyaluran Zakat</h2>

    <form action="{{ route('penyaluran.store') }}" method="POST" class="space-y-4">
        @csrf

        <label for="pembagianId" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pembagian Zakat</label>
        <select name="pembagianId" id="pembagianId" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            <option value="">-- Pilih Pembagian Zakat --</option>
            @foreach ($pembagian as $item)
                <option value="{{ $item->pembagianId }}">
                    Tahun {{ $item->tahun }}
                </option>
            @endforeach
        </select>


        <div>
            <label class="block font-semibold mb-1">Penerima Zakat</label>
            <select id="penerimaSelect" name="penerimaId" class="w-full border p-2 rounded" required>
                <option value="">Pilih Penerima</option>
                @foreach($penerimas as $p)
                    <option value="{{ $p->penerimaId }}">{{ $p->namaKepalaKeluarga }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Jenis Zakat</label>
            <select name="jenisId" class="w-full border p-2 rounded" required>
                <option value="">Pilih Jenis</option>
                @foreach($jenis as $j)
                    <option value="{{ $j->jenisId }}">{{ $j->namaJenisZakat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Status Penyaluran</label>
            <select name="statusId" class="w-full border p-2 rounded" required>
                <option value="">Pilih Status</option>
                @foreach($statuses as $s)
                    <option value="{{ $s->statusId }}">{{ $s->namaStatus }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Amil</label>
            <input type="text" class="w-full border p-2 rounded bg-gray-100 text-gray-700" value="{{ Auth::user()->name }}" readonly>
            <input type="hidden" name="amilId" value="{{ Auth::id() }}">
        </div>


        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#penerimaSelect').select2({
            placeholder: "Cari nama kepala keluarga...",
            allowClear: true
        });
    });
</script>

@endsection
