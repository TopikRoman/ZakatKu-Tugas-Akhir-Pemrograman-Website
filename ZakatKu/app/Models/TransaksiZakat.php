<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PembayaranZakat;
use App\Models\JenisZakat;
use App\Models\BentukZakat;
use App\Models\StatusPembayaran;

class TransaksiZakat extends Model
{
    public $timestamps = false;
    protected $table = 'transaksi_zakat';
    protected $primaryKey = 'transaksiZakatId';
    protected $fillable = [
        'userId', 'pembayaranZakatId', 'jenisId', 'bentukId',
        'jumlah', 'tanggalTransaksi', 'statusPembayaranId', 'metodePembayaranId', 'image',
        'atasNama', 'noReferensi' // tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function pembayaranZakat()
    {
        return $this->belongsTo(PembayaranZakat::class, 'pembayaranZakatId');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisZakat::class, 'jenisId');
    }

    public function bentuk()
    {
        return $this->belongsTo(BentukZakat::class, 'bentukId');
    }

    public function statusPembayaran()
    {
        return $this->belongsTo(StatusPembayaran::class, 'statusPembayaranId');
    }
}
