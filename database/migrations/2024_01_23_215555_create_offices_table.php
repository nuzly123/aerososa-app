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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('office', 50);
            $table->string('code', 50);
            $table->string('phone', 50);
            $table->string('extension', 50);
            $table->string('address', 50);
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->boolean('status')->default(true);
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();

            //Foreign keys:
            $table->foreignId('city_id')->constrained();
            $table->foreignId('station_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('offices'); */
    }
};
