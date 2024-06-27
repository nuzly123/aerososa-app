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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('name')->after('id');
            $table->string('username')->after('name');
            $table->string('email')->unique()->nullable()->after('username');
            $table->rememberToken()->after('reset_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('remember_token');
            $table->dropColumn('username');
            $table->dropColumn('name');
            $table->dropColumn('email');
        });
    }
};
