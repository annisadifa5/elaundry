<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';

    protected $fillable = [
        'kategori',
        'kode_layanan',
        'nama_layanan',
        'satuan',
        'harga',
        'jarak',        // 🔥 TAMBAHAN
        'is_optional',
        'is_active',
        'keterangan',
    ];

    protected $casts = [
        'harga'       => 'integer',
        'jarak'       => 'integer',   // 🔥 TAMBAHAN
        'is_optional' => 'boolean',
        'is_active'   => 'boolean',
    ];

    /* =========================
       SCOPE (biar query bersih)
       ========================= */

    // Laundry aktif
    public function scopeLaundry($query)
    {
        return $query->where('kategori', 'laundry')
                     ->where('is_active', true);
    }

    // Jasa aktif
    public function scopeJasa($query)
    {
        return $query->where('kategori', 'jasa')
                     ->where('is_active', true);
    }

    // Jasa opsional
    public function scopeOptional($query)
    {
        return $query->where('kategori', 'jasa')
                     ->where('is_optional', true)
                     ->where('is_active', true);
    }

    /* =========================
       HELPER METHOD (opsional tapi cakep)
       ========================= */

    public function isLaundry()
    {
        return $this->kategori === 'laundry';
    }

    public function isJasa()
    {
        return $this->kategori === 'jasa';
    }

    public function pakaiJarak()
    {
        return $this->kategori === 'jasa' && $this->satuan === 'km';
    }
}
