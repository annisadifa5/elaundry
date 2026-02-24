<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            if (!Schema::hasColumn('customer', 'member_points')) {
                $table->integer('member_points')->default(0);
            }

            if (!Schema::hasColumn('customer', 'member_code')) {
                $table->string('member_code')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            if (Schema::hasColumn('customer', 'member_points')) {
                $table->dropColumn('member_points');
            }

            if (Schema::hasColumn('customer', 'member_code')) {
                $table->dropColumn('member_code');
            }

        });
    }
};