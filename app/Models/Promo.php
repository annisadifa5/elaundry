<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo';
    protected $primaryKey = 'id_promo';
    protected $fillable = [
        'nama_promo',
        'skema',
        'basis_promo',
        'nilai_promo',
        'minimal_transaksi',
        'maksimal_diskon',
        'kuota',
        'dipakai',
        'role_akses',
        'khusus_member',
        'deskripsi_promo',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
