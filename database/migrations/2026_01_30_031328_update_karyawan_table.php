<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Tidak Aktif'])
                ->default('Aktif')
                ->after('email');

            $table->date('tanggal_masuk')
                ->nullable()
                ->after('status');

            $table->string('nik', 20)
                ->nullable()
                ->after('tanggal_masuk');
        });
    }

    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn(['status', 'tanggal_masuk', 'nik']);
        });
    }
};
