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
        Schema::create('air_traffic', function (Blueprint $table) {

            $table->id();
            $table->date('flight_date');
            $table->time('departure');
            $table->time('arrival')->nullable();
            $table->string('flight_route');
            $table->integer('flight_status'); //valores 0 Matricula , 1 Adelantado, 2 ON-TIME, 3 Delayed

            //pasajeros
            $table->integer('px');
            $table->integer('dh');
            $table->integer('inf');
            $table->integer('total_passengers');

            //tripulacion
            $table->foreignId('captain_id');
            $table->foreignId('first_official_id');
            /* $table->foreignId('flight_assistant_id'); */
            $table->string('obsservant')->nullable();

            //calculo de libras
            $table->integer('px_lbs');
            $table->integer('freight');
            $table->integer('trans_weight');
            $table->integer('total_lbs');

            //transito
            $table->integer('trans_tgu');
            $table->integer('trans_sap');
            $table->integer('trans_rtb');
            $table->integer('trans_lce');


            $table->string('remark')->nullable();

            //llaves foraneas
            $table->foreignId('aircraft_id');
            $table->foreignId('flight_id');

            //tripulacion
            $table->foreign('captain_id')->references('id')->on('employees');
            $table->foreign('first_official_id')->references('id')->on('employees');
            /* $table->foreign('flight_assistant_id')->references('id')->on('employees'); */

            //
            $table->foreign('aircraft_id')->references('id')->on('aircrafts');
            $table->foreign('flight_id')->references('id')->on('flights');

            //default columns
            //$table->boolean('status')->default(true);
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('air_traffic'); */
    }
    
};
