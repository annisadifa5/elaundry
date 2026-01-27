<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_users';
    protected $fillable = ['nama', 'email', 'password', 'role', 'no_telp'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id_users', 'id_users');
    }

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_user', 'id_users');
    }
}
