<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembagian extends Model
{
    use HasFactory;

    protected $table = 'status_pembagian';
    protected $primaryKey = 'statusId';
    protected $fillable = ['namaStatus'];

    public function penyaluran()
    {
        return $this->hasMany(PenyaluranZakat::class, 'statusId');
    }
}
