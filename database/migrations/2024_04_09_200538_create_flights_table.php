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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code'); //numero de vuelo
            $table->foreignId('flight_route_id')->nullable(); //de donde sale
            $table->time('departure'); //hora de salida
            $table->time('arrival')->nullable(); //hora de llegada
            /* $table->string('frecuency'); //dia que vuela */
            $table->time('flight_time'); //duracion
            $table->boolean('status')->default(true);
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();

            //llaves foraneas
            $table->foreign('flight_route_id')->references('id')->on('flight_routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
