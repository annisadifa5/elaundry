<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemasukan', function (Blueprint $table) {
    $table->id('id_pemasukan');
    $table->string('kode_pemasukan')->unique();
    $table->date('tanggal');
    $table->decimal('jumlah', 15, 2);
    $table->string('sumber')->nullable();
    $table->string('metode_pembayaran')->nullable();

    $table->unsignedBigInteger('id_pemesanan')->nullable();
    $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('cascade');

    $table->unsignedBigInteger('id_cust')->nullable();
    $table->foreign('id_cust')->references('id_cust')->on('customer')->onDelete('cascade');

    $table->unsignedBigInteger('id_outlet')->nullable();
    $table->foreign('id_outlet')->references('id_outlet')->on('outlet')->onDelete('cascade');

    $table->text('keterangan')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
