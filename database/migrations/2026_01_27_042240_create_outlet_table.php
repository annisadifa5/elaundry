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
        Schema::create('outlet', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->id('id_outlet');
        $table->string('nama_outlet');
        $table->string('jalan');
        $table->string('kelurahan');
        $table->string('kecamatan');
        $table->string('kota_kab');
        $table->string('provinsi');
        $table->string('kode_pos');
        $table->string('email');
        $table->string('no_telp');
        $table->string('website')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlet');
    }
};
