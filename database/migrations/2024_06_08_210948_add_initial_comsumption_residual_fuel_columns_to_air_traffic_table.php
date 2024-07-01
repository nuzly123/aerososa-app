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
        Schema::table('air_traffic', function (Blueprint $table) {
            //
            $table->integer('initial_fuel')->after('flight_id');
            $table->integer('fuel_consumption')->after('initial_fuel');
            $table->integer('residual_fuel')->after('fuel_consumption');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::table('air_traffic', function (Blueprint $table) {
            //
            $table->dropColumn('initial_fuel');
            $table->dropColumn('fuel_consumption');
            $table->dropColumn('residual_fuel');           
        }); */
    }
};
