<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Zakat {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Transaksi Zakat Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Jenis Zakat</th>
                <th>Bentuk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Atas Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $i => $trx)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>{{ $trx->jenis->namaJenisZakat ?? '-' }}</td>
                <td>{{ $trx->bentuk->namaBentukZakat ?? '-' }}</td>
                <td>Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggalTransaksi)->format('d-m-Y') }}</td>
                <td>{{ $trx->atasNama ?? '-' }}</td>
                <td>{{ $trx->statusPembayaran->namaStatus ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
