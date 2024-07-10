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
        Schema::table('Air_Traffic', function (Blueprint $table) {
            //
            $table->dropForeign(['fueling_id']);
            $table->dropColumn('fueling_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Air_Traffic', function (Blueprint $table) {
            //
        });
    }
};
