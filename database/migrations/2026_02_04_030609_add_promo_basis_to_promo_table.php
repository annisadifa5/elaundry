<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('promo', function (Blueprint $table) {

            // BASIS PROMO (nominal / persentase)
            $table->enum('basis_promo', ['nominal', 'persentase'])
                  ->after('skema');

            // NILAI PROMO (Rp atau %)
            $table->decimal('nilai_promo', 10, 2)
                  ->after('basis_promo');

            // MINIMAL TRANSAKSI
            $table->decimal('minimal_transaksi', 10, 2)
                  ->default(0)
                  ->after('nilai_promo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->dropColumn([
                'basis_promo',
                'nilai_promo',
                'minimal_transaksi'
            ]);
        });
    }
};
