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
        Schema::table('aircrafts', function (Blueprint $table) {
            //
            $table->integer('residual_fuel_id')->nullable()/* ->constrained('residual_fuel') */;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::table('aircrafts', function (Blueprint $table) {
            //
            //$table->dropForeign(['residual_fuel_id']);
            $table->dropColumn('residual_fuel_id');
        }); */
    }
};
