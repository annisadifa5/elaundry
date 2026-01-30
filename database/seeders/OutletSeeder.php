<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        Outlet::create([
            'nama_outlet' => 'Outlet Utama',
            'jalan' => 'Jl. Laundry',
            'kelurahan' => 'Contoh',
            'kecamatan' => 'Contoh',
            'kota_kab' => 'Kota Test',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => '40123',
            'email' => 'outlet@test.com',
            'no_telp' => '022123456',
            'website' => 'https://laundry.test',
        ]);
    }
}
