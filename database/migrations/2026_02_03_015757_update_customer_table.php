<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            // 1. email & password jadi nullable
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();

            // 2. hapus foreign key & kolom id_user
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');

            // 3. tambah kolom lokasi (link URL)
            $table->string('lokasi')->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            // balikin id_user
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // balikin email & password NOT NULL
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();

            // hapus lokasi
            $table->dropColumn('lokasi');
        });
    }
};
