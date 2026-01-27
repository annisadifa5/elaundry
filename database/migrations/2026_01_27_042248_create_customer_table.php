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
        Schema::create('customer', function (Blueprint $table) {
        $table->id('id_cust');
        $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
        $table->string('email');
        $table->string('password');
        $table->string('nama_lengkap');
        $table->text('alamat');
        $table->string('no_telp');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
