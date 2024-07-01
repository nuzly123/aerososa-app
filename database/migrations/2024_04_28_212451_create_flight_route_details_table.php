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
        Schema::create('flight_route_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('aircraft_type_id');
            $table->string('time');
            $table->integer('fuel');
            $table->boolean('status')->default(true);
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();


            // Foreign keys
            $table->foreign('route_id')->references('id')->on('flight_routes')->onDelete('cascade');
            $table->foreign('aircraft_type_id')->references('id')->on('aircraft_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('flight_route_details'); */
    }
};
