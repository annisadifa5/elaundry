<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackPemesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_track';
    protected $fillable = ['id_pemesanan','nama_lengkap','pembayaran','proses','jenis_layanan','tanggal_mulai','tanggal_selesai'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}
