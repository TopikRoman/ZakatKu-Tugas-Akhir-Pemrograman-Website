<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisZakat extends Model
{
    use HasFactory;

    protected $table = 'jenis_zakat';
    protected $primaryKey = 'jenisId';
    protected $fillable = ['namaJenisZakat'];

    public function transaksi()
    {
        return $this->hasMany(TransaksiZakat::class, 'jenisId');
    }

    public function penyaluran()
    {
        return $this->hasMany(PenyaluranZakat::class, 'jenisId');
    }
}
