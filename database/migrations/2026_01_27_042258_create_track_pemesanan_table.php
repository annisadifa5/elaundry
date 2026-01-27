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
        Schema::create('track_pemesanan', function (Blueprint $table) {
        $table->id('id_track');
        $table->string('nama_lengkap');
        $table->string('pembayaran');
        $table->string('proses');
        $table->string('jenis_layanan');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai')->nullable();
        $table->unsignedBigInteger('id_pemesanan');
        $table->foreign('id_pemesanan')
      ->references('id_pemesanan') // sesuai PK di pemesanan
      ->on('pemesanan')
      ->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_pemesanan');
    }
};
