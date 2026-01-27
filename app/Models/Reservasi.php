<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reservasi';
    protected $fillable = ['id_cust','jenis_layanan','tipe_pemesanan','tanggal_jemput','jam_jemput','catatan_khusus','alamat_jemput'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id_cust');
    }
}
