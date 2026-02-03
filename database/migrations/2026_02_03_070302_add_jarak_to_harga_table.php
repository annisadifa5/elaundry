<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('harga', function (Blueprint $table) {
            $table->integer('jarak')->nullable()->after('harga');
        });
    }

    public function down(): void
    {
        Schema::table('harga', function (Blueprint $table) {
            $table->dropColumn('jarak');
        });
    }
};
