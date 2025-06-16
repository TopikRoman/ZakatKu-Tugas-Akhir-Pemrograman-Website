<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TransaksiZakat;
use App\Models\PenyaluranZakat;
use Carbon\Carbon;

class dashBoardAdmin extends Controller
{

    public function index()
    {
        $totalMuzakki = User::where('roleId', 2)->count();

        $totalPending = TransaksiZakat::where('statusPembayaranId', 3)->count();

        $totalTahunIni = TransaksiZakat::whereHas('pembayaranZakat', function ($query) {
            $query->where('tahun', Carbon::now()->year);
        })->count();

        // ✅ Tambahkan: Total penyaluran tahun ini dengan statusId = 2
        $totalPembagianTahunIni = PenyaluranZakat::where('statusId', 2)
            ->whereHas('pembagian', function ($query) {
                $query->where('tahun', Carbon::now()->year);
            })
            ->count();

        return view('admin.adminDashboard', compact(
            'totalMuzakki',
            'totalPending',
            'totalTahunIni',
            'totalPembagianTahunIni'
        ));
    }

}
