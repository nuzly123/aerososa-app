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
        Schema::create('residual_fuel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aircraft_id');
            $table->foreignId('air_traffic_id')->nullable(); //en caso de que se ingrese el remanente desde aicrafts view
            $table->integer('residual_fuel_amount');
            $table->timestamps();

            $table->foreign('aircraft_id')->references('id')->on('aircrafts')->onDelete('cascade');
            $table->foreign('air_traffic_id')->references('id')->on('air_traffic')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('residual_fuel'); */
    }
};
