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
           
            $table->dropColumn(['location', 'profile_image']);
            $table->string('phone_number')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('location')->nullable(); 
            $table->string('profile_image')->nullable(); 

            $table->dropColumn(['phone_number']);
        });
    }
};
