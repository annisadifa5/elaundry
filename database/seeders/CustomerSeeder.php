<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create([
            // 'id_user' => 1,
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'nama_lengkap' => 'Customer Test',
            'alamat' => 'Jl. Contoh',
            'no_telp' => '08123456789',
        ]);
    }
}
