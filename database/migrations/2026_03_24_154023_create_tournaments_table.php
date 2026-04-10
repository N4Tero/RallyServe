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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // e.g., Gensan Summer Smash 2026
            $table->string('date_range');          // e.g., March 15-16, 2026
            $table->string('format');              // e.g., Mixed Doubles
            $table->string('status');              // e.g., open, soon, or closed
            $table->string('prize_details');       // e.g., ₱50,000 Total Prize Pool
            $table->string('registration_link')->nullable(); // Optional link if using external forms
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
