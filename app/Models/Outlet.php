<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlet';
    protected $primaryKey = 'id_outlet';
    protected $fillable = ['nama_outlet','jalan','kelurahan','kecamatan','kota_kab','provinsi','kode_pos','email','no_telp','website','latitude','longitude',];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_outlet', 'id_outlet');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_outlet', 'id_outlet');
    }
}
