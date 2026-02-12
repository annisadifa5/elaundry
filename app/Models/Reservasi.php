<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $timestamps = true;

    protected $fillable = [
        'id_cust',
        'jenis_layanan',
        'tipe_pemesanan',
        'tanggal_jemput',
        'jam_jemput',
        'alamat_jemput',
        'jumlah_item',
        'total_harga',
        'catatan_khusus',
        'status_proses',   // 🔥 tambahkan
        'status_bayar'     // 🔥 tambahkan
];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }
}
