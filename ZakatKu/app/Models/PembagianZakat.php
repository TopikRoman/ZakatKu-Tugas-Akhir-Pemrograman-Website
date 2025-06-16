<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianZakat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pembagian_zakat';
    protected $primaryKey = 'pembagianId';
    protected $fillable = ['tahun'];

    public function penyaluran()
    {
        return $this->hasMany(PenyaluranZakat::class, 'pembagianId');
    }
}
