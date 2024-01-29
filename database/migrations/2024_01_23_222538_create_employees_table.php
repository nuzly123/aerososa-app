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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->string('phome', 50);
            $table->string('email', 50)->unique();
            $table->dateTime('birth');
            $table->string('address');
            $table->string('position', 50);
            $table->dateTime('entry_date');
            $table->boolean('status');
            $table->integer('user_create');
            $table->integer('user_update');
            $table->timestamps();

            //Foreign keys:
            $table->foreignId('department_id')->constrained();
            $table->foreignId('office_id')->constrained();
            $table->foreignId('contract_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
