<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'metodePembayaranId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'namaMetode',
    ];

    // Relasi ke transaksi zakat (One to Many)
    public function transaksiZakat()
    {
        return $this->hasMany(TransaksiZakat::class, 'metodePembayaranId', 'metodePembayaranId');
    }
}
