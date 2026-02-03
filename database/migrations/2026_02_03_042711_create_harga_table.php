<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('harga', function (Blueprint $table) { 
            $table->id();
            $table->enum('kategori', ['laundry', 'jasa']);
            $table->string('kode_layanan');
            $table->string('nama_layanan');
            $table->enum('satuan', ['kg', 'pcs']);
            $table->integer('harga');
            $table->boolean('is_optional')->default(false);
            $table->boolean('is_active')->default(true);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga'); 
    }
};
