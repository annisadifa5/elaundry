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
        Schema::create('reservasi', function (Blueprint $table) {
        $table->id('id_reservasi');
        $table->unsignedBigInteger('id_cust');
        $table->foreign('id_cust')
          ->references('id_cust')
          ->on('customer')
          ->cascadeOnDelete();
        $table->string('jenis_layanan');
        $table->string('tipe_pemesanan');
        $table->date('tanggal_jemput');
        $table->time('jam_jemput');
        $table->text('catatan_khusus')->nullable();
        $table->text('alamat_jemput');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
