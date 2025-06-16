<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PembagianZakat;
use App\Models\PenyaluranZakat;
use App\Models\PenerimaZakat;
use App\Models\StatusPembagian;
use App\Models\JenisZakat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminPenyaluranZakatController extends Controller
{
    public function createForm()
    {
        $pembagian = PembagianZakat::all();
        $penerimas = PenerimaZakat::all();
        $statuses = StatusPembagian::all();
        $jenis = JenisZakat::all();

        $amil = Auth::user(); // hanya pengguna yang sedang login

        return view('admin.tambahPenyaluran', compact('pembagian', 'penerimas', 'statuses', 'jenis', 'amil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembagianId' => 'required|exists:pembagian_zakat,pembagianId',
            'penerimaId' => 'required|exists:penerima_zakat,penerimaId',
            'jenisId' => 'required|exists:jenis_zakat,jenisId',
            'statusId' => 'required|exists:status_pembagian,statusId',
            'amilId' => 'required|exists:users,id',
        ]);

        PenyaluranZakat::create([
            'pembagianId' => $request->pembagianId,
            'penerimaId' => $request->penerimaId,
            'jenisId' => $request->jenisId,
            'statusId' => $request->statusId,
            'amilId' => $request->amilId,
        ]);

        return redirect()->route('pembagian.index')->with('success', 'Data penyaluran berhasil ditambahkan.');
    }

    public function exportPdf($tahun)
    {
        $penyalurans = PenyaluranZakat::with(['penerima', 'jenis', 'status', 'amil'])
            ->whereHas('pembagian', function ($query) use ($tahun) {
                $query->where('tahun', $tahun);
            })
            ->get();

        if ($penyalurans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data penyaluran untuk tahun tersebut.');
        }

        $pdf = Pdf::loadView('admin.templatePDF.templatePenyaluran', [
            'penyalurans' => $penyalurans,
            'tahun' => $tahun
        ])->setPaper('A4', 'portrait');

        return $pdf->download("penyaluran-zakat-$tahun.pdf");
    }
}
