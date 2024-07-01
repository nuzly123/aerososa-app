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
        Schema::table('flight_routes', function (Blueprint $table) {
            //
            $table->foreignId('origin_city_id')->nullable()->after("route");/* ->constrained('residual_fuel') */;
            $table->foreignId('destination_city_id')->nullable()->after("origin_city_id");

            $table->foreign('origin_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('destination_city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::table('flight_routes', function (Blueprint $table) {
            //
            $table->dropForeign(['origin_city_id']);
            $table->dropColumn('origin_city_id');

            $table->dropForeign(['destination_city_id']);
            $table->dropColumn('destination_city_id');
        }); */
    }
};
