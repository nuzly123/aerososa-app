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
        Schema::create('flight_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('air_traffic_id');
            $table->foreignId('employee_id');
            $table->time('pilot_flight_time');
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();

            $table->foreign('air_traffic_id')->references('id')->on('air_traffic')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('flight_hours'); */
    }
};
