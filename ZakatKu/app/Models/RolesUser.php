<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    use HasFactory;

    // Jika nama tabel tidak mengikuti konvensi plural, sebutkan secara eksplisit
    protected $table = 'roles_user';

    // Jika primary key bukan "id"
    protected $primaryKey = 'roleId';

    // Jika tidak pakai UUID atau increment manual
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Mass assignable fields
    protected $fillable = [
        'namaRoles',
    ];

    // Relasi ke users
    public function users()
    {
        return $this->hasMany(User::class, 'roleId');
    }
}
