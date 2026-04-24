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

    Schema::dropIfExists('bookings');
       Schema::create('bookings', function (Blueprint $table) {
           $table->id();
            
            // The unique receipt/tracking number
            $table->string('reference_number')->unique();
            
            // Who made the booking?
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            // WHICH specific court did they book? (This is the column you were missing!)
            $table->foreignId('court_id')->constrained('courts')->cascadeOnDelete();
            
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            
            // Pending, Approved, or Cancelled
            $table->string('status')->default('Pending');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
