<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
    $table->id('id_pengeluaran');
    $table->string('kode_pengeluaran')->unique();
    $table->date('tanggal');
    $table->decimal('jumlah', 15, 2);
    $table->string('kategori')->nullable(); // operasional, gaji, listrik, dll

    $table->unsignedBigInteger('id_outlet')->nullable();
    $table->foreign('id_outlet')
          ->references('id_outlet') // sesuai PK di tabel outlet
          ->on('outlet')
          ->onDelete('cascade');

    $table->text('keterangan')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
