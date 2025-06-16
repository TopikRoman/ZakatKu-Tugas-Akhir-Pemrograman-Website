@extends('layouts.adminLayout')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-green-800 border-b-2 border-green-300 pb-2">
            Transaksi Zakat Tahun {{ $tahun->tahun }}
        </h1>

        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('transaksi.create') }}"
            class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded shadow transition">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </a>

            <a href="{{ route('admin.zakat.exportPdf', ['tahun' => $tahun->tahun]) }}"
            class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded shadow transition">
                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>



    @if($transaksis->isEmpty())
        <p class="text-gray-500 mt-10">Belum ada transaksi untuk tahun ini.</p>
    @else
        <div class="space-y-4">
            @foreach($transaksis as $trx)
                @php
                    $statusClass = match($trx->statusPembayaranId) {
                        1 => 'bg-red-100 text-red-700',
                        2 => 'bg-green-100 text-green-700',
                        3 => 'bg-yellow-100 text-yellow-700',
                        4 => 'bg-orange-100 text-orange-700',
                        default => 'bg-gray-100 text-gray-700',
                    };
                @endphp
                    <div class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="space-y-1">
                            <p class="text-lg text-gray-800 font-semibold">
                                {{ $trx->user->name }} — {{ $trx->jenis->namaJenisZakat ?? 'Zakat' }} ({{ $trx->bentuk->namaBentukZakat ?? '-' }})
                            </p>
                        @php
                            $bentuk = strtolower($trx->bentuk->namaBentukZakat ?? '');
                            $jumlahFormatted = '';

                            switch ($bentuk) {
                                case 'uang':
                                    $jumlahFormatted = 'Rp ' . number_format($trx->jumlah, 0, ',', '.');
                                    break;
                                case 'emas':
                                    $jumlahFormatted = number_format($trx->jumlah, 2, ',', '.') . ' gr';
                                    break;
                                case 'beras':
                                    $jumlahFormatted = number_format($trx->jumlah, 2, ',', '.') . ' kg';
                                    break;
                                default:
                                    $jumlahFormatted = number_format($trx->jumlah, 0, ',', '.');
                                    break;
                            }
                        @endphp

                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($trx->tanggalTransaksi)->format('d M Y') }} • {{ $jumlahFormatted }}
                        </p>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                {{ $trx->statusPembayaran->namaStatus ?? 'Pending' }}
                            </span>
                            <button onclick='showModal(@json($trx))' class="text-green-600 hover:text-green-800">
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
        <h2 class="text-xl font-bold mb-4 text-green-700">Detail Transaksi Zakat</h2>

        <div id="modalContent" class="space-y-3 text-sm text-gray-700"></div>
    </div>
</div>

<script>
    function showModal(data) {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('modalContent');
        const formattedDate = new Date(data.tanggalTransaksi).toLocaleDateString('id-ID', {
            day: 'numeric', month: 'long', year: 'numeric'
        });

        let satuan = '';
        const bentuk = data.bentuk?.namaBentukZakat?.toLowerCase();

        if (bentuk === 'uang') {
            satuan = 'Rp ' + Number(data.jumlah).toLocaleString('id-ID');
        } else if (bentuk === 'emas') {
            satuan = Number(data.jumlah).toLocaleString('id-ID') + ' gram';
        } else if (bentuk === 'beras') {
            satuan = Number(data.jumlah).toLocaleString('id-ID') + ' kg';
        } else {
            satuan = Number(data.jumlah).toLocaleString('id-ID'); // fallback tanpa satuan
        }

        content.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                <div><span class="font-semibold text-gray-800">Nama Pengguna:</span><br>${data.user?.name ?? '-'}</div>
                <div><span class="font-semibold text-gray-800">Jenis Zakat:</span><br>${data.jenis?.namaJenisZakat ?? '-'}</div>
                <div><span class="font-semibold text-gray-800">Bentuk Zakat:</span><br>${data.bentuk?.namaBentukZakat ?? '-'}</div>
                <div><span class="font-semibold text-gray-800">Jumlah:</span><br>${satuan}</div>
                <div><span class="font-semibold text-gray-800">Tanggal:</span><br>${formattedDate}</div>
                <div><span class="font-semibold text-gray-800">Atas Nama:</span><br>${data.atasNama}</div>
                <div><span class="font-semibold text-gray-800">Status Pembayaran:</span><br>${data.statusPembayaran?.namaStatus ?? '-'}</div>
            </div>
            ${data.image
                ? `<div class="mt-6 border-t pt-4">
                    <p class="font-semibold text-gray-800 mb-2">Bukti Pembayaran:</p>
                    <img src="/storage/${data.image}" alt="Bukti Pembayaran" class="w-full max-w-md rounded-lg border shadow">
                </div>`
                : `<div class="mt-6 border-t pt-4 text-red-500 italic">Belum ada bukti pembayaran</div>`
            }
        `;

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }
</script>
@endsection
