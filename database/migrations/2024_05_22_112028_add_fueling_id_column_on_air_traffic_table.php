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
        //
        Schema::table('air_traffic', function (Blueprint $table) {
            //
            $table->foreignId("fueling_id")->nullable()->after("flight_id");
            $table->foreign('fueling_id')->references('id')->on('fuelings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        /* Schema::table('air_traffic', function (Blueprint $table) {
            //
            $table->dropForeign(['fueling_id']);
            $table->dropColumn('fueling_id');
        }); */
    }
};
