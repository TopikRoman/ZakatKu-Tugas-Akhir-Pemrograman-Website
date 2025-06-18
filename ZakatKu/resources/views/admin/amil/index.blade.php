@extends('layouts.adminLayout')

@section('title', 'Data Amil')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Amil</h2>

    <button onclick="openModal('create')" class="inline-block mb-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        + Tambah
    </button>

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

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#ef4444'
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#ef4444'
        });
    </script>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">No HP</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($amils as $a)
                    <tr>
                        <td class="px-6 py-4">{{ $a->name }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">{{ $a->alamat }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">{{ $a->nomorTelepon }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <button onclick='openModal("detail", @json($a))' class="text-green-600 hover:underline">Detail</button>
                            <button onclick='openModal("edit", @json($a))' class="text-blue-600 hover:underline">Edit</button>
                            <form action="{{ route('amil.destroy', $a->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data amil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✖</button>

        <!-- Dynamic content -->
        <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-6"></h2>

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
            modalTitle.innerText = 'Tambah Amil';
            modalForm.action = "{{ route('amil.store') }}";
            modalFields.innerHTML = `
                <div><label>Nama:</label><input type="text" name="name" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Username:</label><input type="text" name="username" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Email:</label><input type="email" name="email" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Alamat:</label><textarea name="alamat" class="w-full border rounded px-3 py-2" required></textarea></div>
                <div><label>Nomor Telepon:</label><input type="text" name="nomorTelepon" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Password:</label><input type="password" name="password" class="w-full border rounded px-3 py-2" required></div>
                <input type="hidden" name="roleId" value="3">
            `;
        } else if (type === 'edit') {
            modalTitle.innerText = 'Edit Amil';
            modalForm.action = `/admin/amil/${data.id}`;
            formMethod.value = 'PUT';
            modalFields.innerHTML = `
                <div><label>Nama:</label><input type="text" name="name" value="${data.name}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Username:</label><input type="text" name="username" value="${data.username}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Email:</label><input type="email" name="email" value="${data.email}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Alamat:</label><textarea name="alamat" class="w-full border rounded px-3 py-2" required>${data.alamat}</textarea></div>
                <div><label>Nomor Telepon:</label><input type="text" name="nomorTelepon" value="${data.nomorTelepon}" class="w-full border rounded px-3 py-2" required></div>
                <div><label>Password (kosongkan jika tidak diubah):</label><input type="password" name="password" class="w-full border rounded px-3 py-2"></div>
                <input type="hidden" name="roleId" value="3">
            `;
        } else if (type === 'detail') {
            modalTitle.innerText = 'Detail Amil';
            modalForm.classList.add('hidden');
            modalSubmitBtn.classList.add('hidden');
            modalDetail.classList.remove('hidden');
            modalDetail.innerHTML = `
                <div><strong>Nama:</strong> ${data.name}</div>
                <div><strong>Username:</strong> ${data.username}</div>
                <div><strong>Email:</strong> ${data.email}</div>
                <div><strong>Alamat:</strong> ${data.alamat}</div>
                <div><strong>Nomor Telepon:</strong> ${data.nomorTelepon}</div>
            `;
        }
    }

    function closeModal() {
        modalOverlay.classList.add('hidden');
    }
</script>
@endsection
