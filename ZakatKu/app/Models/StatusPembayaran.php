<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembayaran extends Model
{
    use HasFactory;

    protected $table = 'status_pembayaran';
    protected $primaryKey = 'statusPembayaranId';
    protected $fillable = ['namaStatus'];

    public function transaksi()
    {
        return $this->hasMany(TransaksiZakat::class, 'statusPembayaranId');
    }
}
