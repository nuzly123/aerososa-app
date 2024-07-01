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
        Schema::create('fuelings', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('fuel_amount');
            $table->string('approved_by');
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();

            //
            $table->foreignId('aircraft_id');
            $table->foreignId('airport_id');

            //
            $table->foreign('aircraft_id')->references('id')->on('aircrafts')->onDelete('cascade');
            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('fuelings'); */
    }
};
