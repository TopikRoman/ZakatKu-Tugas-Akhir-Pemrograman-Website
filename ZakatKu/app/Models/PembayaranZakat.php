<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranZakat extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_zakat';
    protected $primaryKey = 'pembayaranZakatId';
    protected $fillable = ['tahun'];

    public function transaksi()
    {
        return $this->hasMany(TransaksiZakat::class, 'pembayaranZakatId');
    }
}
