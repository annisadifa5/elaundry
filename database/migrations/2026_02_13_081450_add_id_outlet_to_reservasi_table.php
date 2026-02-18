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
        Schema::table('reservasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_outlet')
                ->nullable()
                ->after('id_reservasi');
        });

        // isi data lama dengan outlet default 3
        DB::table('reservasi')
            ->update(['id_outlet' => 3]);

        Schema::table('reservasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_outlet')
                ->nullable(false)
                ->change();

            $table->foreign('id_outlet')
                ->references('id_outlet')
                ->on('outlet')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign(['id_outlet']);
            $table->dropColumn('id_outlet');
        });
    }
};
