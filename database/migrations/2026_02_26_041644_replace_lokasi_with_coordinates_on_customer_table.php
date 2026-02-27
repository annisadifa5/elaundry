<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            // hapus kolom lama
            if (Schema::hasColumn('customer', 'lokasi')) {
                $table->dropColumn('lokasi');
            }

            // tambah kolom baru
            $table->decimal('latitude', 10, 8)->nullable()->after('alamat');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            $table->string('lokasi')->nullable();

            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};