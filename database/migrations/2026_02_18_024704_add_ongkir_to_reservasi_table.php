<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->integer('ongkir')->default(0)->after('total_harga');

            // HAPUS BARIS INI:
            // $table->text('lokasi')->nullable()->after('alamat_jemput');
        });
    }

    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn('ongkir');

            // Tidak perlu drop lokasi karena tidak pernah dibuat
        });
    }
};
