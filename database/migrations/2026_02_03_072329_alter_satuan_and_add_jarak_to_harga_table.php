<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSatuanAndAddJarakToHargaTable extends Migration
{
    public function up(): void
    {
        // ➜ CEK DULU DI LUAR
        if (!Schema::hasColumn('harga', 'jarak')) {
            Schema::table('harga', function (Blueprint $table) {
                $table->integer('jarak')->nullable()->after('harga');
            });
        }

        // ➜ ENUM BISA TERPISAH
        Schema::table('harga', function (Blueprint $table) {
            $table->enum('satuan', ['kg', 'pcs', 'km'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('harga', function (Blueprint $table) {
            $table->enum('satuan', ['kg', 'pcs'])->change();

            if (Schema::hasColumn('harga', 'jarak')) {
                $table->dropColumn('jarak');
            }
        });
    }
}
