<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penyaluran Zakat {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Laporan Penyaluran Zakat Tahun {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penerima</th>
                <th>Jenis Zakat</th>
                <th>Status</th>
                <th>Amil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyalurans as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->penerima->namaKepalaKeluarga ?? '-' }}</td>
                    <td>{{ $data->jenis->namaJenisZakat ?? '-' }}</td>
                    <td>{{ $data->status->namaStatus ?? '-' }}</td>
                    <td>{{ $data->amil->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
