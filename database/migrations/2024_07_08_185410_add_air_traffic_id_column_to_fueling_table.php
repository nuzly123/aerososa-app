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
        Schema::table('Fuelings', function (Blueprint $table) {
            //
            $table->foreignId('air_traffic_id')->nullable();
            $table->foreign('air_traffic_id')->references('id')->on('air_traffic')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Fuelings', function (Blueprint $table) {
            //
        });
    }
};
