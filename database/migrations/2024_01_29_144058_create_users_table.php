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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user', 50);
            $table->string('password');
            $table->integer('reset_password');
            $table->boolean('status')->default(true);
            $table->integer('user_create');
            $table->integer('user_update')->nullable();
            $table->timestamps();

            //Foreign keys:
            $table->foreignId('employee_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /* Schema::dropIfExists('users'); */
    }
};
