<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaZakat extends Model
{
    use HasFactory;

    protected $table = 'penerima_zakat';
    protected $primaryKey = 'penerimaId';
    protected $fillable = ['namaKepalaKeluarga', 'alamat', 'noTelepon'];

    public function penyaluran()
    {
        return $this->hasMany(PenyaluranZakat::class, 'penerimaId');
    }
}
