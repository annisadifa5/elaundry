<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPemesanan extends Model
{
    use HasFactory;

    protected $table = 'history_pemesanan';
    protected $primaryKey = 'id_history';
    protected $fillable = ['id_pemesanan','pembayaran','tipe_pemesanan','status','jenis_layanan','periode'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}
