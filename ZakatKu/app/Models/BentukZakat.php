<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BentukZakat extends Model
{
    use HasFactory;

    protected $table = 'bentuk_zakat';
    protected $primaryKey = 'bentukId';
    protected $fillable = ['namaBentukZakat'];

    public function transaksi()
    {
        return $this->hasMany(TransaksiZakat::class, 'bentukId');
    }
}
