<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
    'id_user',
    'id_outlet',
    'nama_karyawan',
    'alamat',
    'jabatan',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'tanggal_masuk', // ✅ TAMBAH INI
    'nik',
    'agama',
    'status',
    'no_hp',
    'email'
];

    // ⭐ TAMBAHAN INI
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet', 'id_outlet');
    }
}
