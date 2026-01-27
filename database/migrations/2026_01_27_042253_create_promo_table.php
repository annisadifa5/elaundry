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
        Schema::create('promo', function (Blueprint $table) {
        $table->id('id_promo');
        $table->string('nama_promo');
        $table->text('deskripsi_promo');
        $table->string('skema');
        $table->string('status');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
