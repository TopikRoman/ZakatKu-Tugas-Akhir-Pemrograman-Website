<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PenerimaZakat;
use App\Models\PembagianZakat;
use App\Models\StatusPembagian;
use App\Models\JenisZakat;

class PenyaluranZakat extends Model
{
    use HasFactory;

    protected $table = 'penyaluran_zakat';
    protected $primaryKey = 'penyaluranId';
    protected $fillable = [
        'penerimaId', 'pembagianId', 'statusId', 'jenisId', 'amilId'
    ];

    public function penerima()
    {
        return $this->belongsTo(PenerimaZakat::class, 'penerimaId');
    }

    public function pembagian()
    {
        return $this->belongsTo(PembagianZakat::class, 'pembagianId');
    }

    public function status()
    {
        return $this->belongsTo(StatusPembagian::class, 'statusId');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisZakat::class, 'jenisId');
    }

    public function amil()
    {
        return $this->belongsTo(User::class, 'amilId');
    }
}
