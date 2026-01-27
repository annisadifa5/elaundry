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
        Schema::create('pemesanan', function (Blueprint $table) {
        $table->id('id_pemesanan');
        $table->unsignedBigInteger('id_track')->nullable();
            $table->unsignedBigInteger('id_cust');
            $table->foreign('id_cust')
          ->references('id_cust')
          ->on('customer')
          ->onDelete('cascade');
        $table->unsignedBigInteger('id_outlet');
        $table->foreign('id_outlet')
      ->references('id_outlet') // sesuai nama kolom di outlet
      ->on('outlet')
      ->onDelete('cascade');
        $table->string('jenis_layanan');
        $table->string('tipe_pemesanan');
        $table->string('no_order');
        $table->date('tanggal_masuk');
        $table->date('tanggal_selesai')->nullable();
        $table->float('berat_cucian');
        $table->integer('jumlah_item');
        $table->text('catatan_khusus')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
