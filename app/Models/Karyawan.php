<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_karyawan';
    protected $fillable = ['id_user','id_outlet','nama_karyawan','alamat','jabatan','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','no_hp','email'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_users');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id_outlet');
    }
}
