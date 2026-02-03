<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'id_cust';

    protected $fillable = [
        'email',
        'password',
        'nama_lengkap',
        'alamat',
        'lokasi',
        'no_telp'
    ];

    // ❌ relasi ke user DIHAPUS
    // public function user() {}

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_cust', 'id_cust');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_cust', 'id_cust');
    }
}
