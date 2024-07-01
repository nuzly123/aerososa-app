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
        Schema::create('flight_assistant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_assistant_id');
            $table->foreignId('air_traffic_id');

            $table->foreign('flight_assistant_id')->references('id')->on('employees');
            $table->foreign('air_traffic_id')->references('id')->on('air_traffic');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       /*  Schema::dropIfExists('flight_assistant_details'); */
    }
};
