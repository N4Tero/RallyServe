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
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained('facilities')->cascadeOnDelete();
            // e.g., 'Court 1', 'Main Arena'
            $table->string('court_name'); 
            
            // e.g., 'Hard Court', 'Wood', 'Rubber'
            $table->string('surface_type'); 
            
            // Decimal for money (8 digits total, 2 after the decimal)
            $table->decimal('hourly_rate', 8, 2); 
            
            // Defaults to Active so it immediately shows up on the booking form
            $table->string('status')->default('Active'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
