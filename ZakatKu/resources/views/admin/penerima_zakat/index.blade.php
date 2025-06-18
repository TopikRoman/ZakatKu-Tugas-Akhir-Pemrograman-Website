@extends('layouts.adminLayout')

@section('title', 'Data Mustahik')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Mustahik</h2>

    <button onclick="openModal('create')" class="inline-block mb-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">+ Tambah</button>

    @if(session('success'))
        <script>
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#16a34a' });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({ icon: 'error', title: 'Validasi Gagal!', html: `{!! implode('<br>', $errors->all()) !!}`, confirmButtonColor: '#ef4444' });
            openModal('create');
        </script>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold">Nama Kepala Keluarga</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold">No Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($penerimas as $p)
                    <tr>
                        <td class="px-6 py-4">{{ $p->namaKepalaKeluarga }}</td>
                        <td class="px-6 py-4">{{ $p->alamat }}</td>
                        <td class="px-6 py-4">{{ $p->noTelepon }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button onclick='openModal("detail", @json($p))' class="text-green-600 hover:underline">Detail</button>
                            <button onclick='openModal("edit", @json($p))' class="text-blue-600 hover:underline">Edit</button>
                            <form action="{{ route('penerima_zakat.destroy', $p->penerimaId) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data mustahik.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✖</button>

        <h2 id="modalTitle" class="text-2xl font-bold mb-6"></h2>

        <form id="modalForm" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <div id="modalFields"></div>
            <button type="submit" id="modalSubmitBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Simpan</button>
        </form>

        <div id="modalDetail" class="space-y-4 hidden"></div>
    </div>
</div>

<script>
    const modalOverlay = document.getElementById('modalOverlay');
    const modalTitle = document.getElementById('modalTitle');
    const modalForm = document.getElementById('modalForm');
    const modalFields = document.getElementById('modalFields');
    const modalSubmitBtn = document.getElementById('modalSubmitBtn');
    const modalDetail = document.getElementById('modalDetail');
    const formMethod = document.getElementById('formMethod');

    function openModal(type, data = {}) {
        modalOverlay.classList.remove('hidden');
        modalForm.reset();
        modalFields.innerHTML = '';
        modalDetail.innerHTML = '';
        modalForm.classList.remove('hidden');
        modalDetail.classList.add('hidden');
        modalSubmitBtn.classList.remove('hidden');
        formMethod.value = 'POST';

        if (type === 'create') {
            modalTitle.innerText = 'Tambah Mustahik';
            modalForm.action = "{{ route('penerima_zakat.store') }}";
            modalFields.innerHTML = `
                <div><label>Nama Kepala Keluarga:</label><input type="text" name="namaKepalaKeluarga" value="{{ old('namaKepalaKeluarga') }}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Alamat:</label><textarea name="alamat" class="w-full border rounded px-3 py-2" required>{{ old('alamat') }}</textarea></div>
                <div><label>Nomor Telepon:</label><input type="text" name="noTelepon" value="{{ old('noTelepon') }}" class="w-full border rounded px-3 py-2" required></div>
            `;
        } else if (type === 'edit') {
            modalTitle.innerText = 'Edit Mustahik';
            modalForm.action = `/admin/penerima_zakat/${data.penerimaId}`;
            formMethod.value = 'PUT';
            modalFields.innerHTML = `
                <div><label>Nama Kepala Keluarga:</label><input type="text" name="namaKepalaKeluarga" value="${data.namaKepalaKeluarga}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Alamat:</label><textarea name="alamat" class="w-full border rounded px-3 py-2" required>${data.alamat}</textarea></div>
                <div><label>Nomor Telepon:</label><input type="text" name="noTelepon" value="${data.noTelepon}" class="w-full border rounded px-3 py-2" required></div>
            `;
        } else if (type === 'detail') {
            modalTitle.innerText = 'Detail Mustahik';
            modalForm.classList.add('hidden');
            modalSubmitBtn.classList.add('hidden');
            modalDetail.classList.remove('hidden');
            modalDetail.innerHTML = `
                <div><strong>Nama Kepala Keluarga:</strong> ${data.namaKepalaKeluarga}</div>
                <div><strong>Alamat:</strong> ${data.alamat}</div>
                <div><strong>Nomor Telepon:</strong> ${data.noTelepon}</div>
            `;
        }
    }

    function closeModal() {
        modalOverlay.classList.add('hidden');
    }
</script>
@endsection
