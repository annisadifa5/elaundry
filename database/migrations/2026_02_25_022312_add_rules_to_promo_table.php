<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promo', function (Blueprint $table) {

            // Minimal transaksi untuk bisa pakai promo
            $table->integer('minimal_transaksi')
                  ->default(0)
                  ->after('nilai_promo');

            // Maksimal diskon (khusus persen)
            $table->integer('maksimal_diskon')
                  ->nullable()
                  ->after('minimal_transaksi');

            // Kuota pemakaian promo
            $table->integer('kuota')
                  ->nullable()
                  ->after('maksimal_diskon');

            // Berapa kali sudah dipakai
            $table->integer('dipakai')
                  ->default(0)
                  ->after('kuota');

            // Role yang boleh pakai
            $table->enum('role_akses', ['admin','kasir','semua'])
                  ->default('semua')
                  ->after('dipakai');

            // Khusus member atau tidak
            $table->boolean('khusus_member')
                  ->default(false)
                  ->after('role_akses');
        });
    }

    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->dropColumn([
                'minimal_transaksi',
                'maksimal_diskon',
                'kuota',
                'dipakai',
                'role_akses',
                'khusus_member'
            ]);
        });
    }
};
