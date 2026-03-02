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
        Schema::table('promo', function (Blueprint $table) {
            $table->decimal('minimal_jarak', 8, 2)->nullable();
            $table->decimal('maksimal_jarak', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            //
        });
    }
};
