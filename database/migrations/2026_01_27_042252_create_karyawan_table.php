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
        Schema::create('karyawan', function (Blueprint $table) {
        $table->id('id_karyawan');
        $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
        $table->unsignedBigInteger('id_outlet');
$table->foreign('id_outlet')
      ->references('id_outlet')
      ->on('outlet')
      ->cascadeOnDelete();

        $table->string('nama_karyawan');
        $table->text('alamat');
        $table->string('jabatan');
        $table->string('jenis_kelamin');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('agama');
        $table->string('no_hp');
        $table->string('email');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
