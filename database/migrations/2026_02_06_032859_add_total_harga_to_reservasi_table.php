<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->bigInteger('total_harga')->nullable()->after('jumlah_item');
        });
    }

    public function down()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn('total_harga');
        });
    }
};
