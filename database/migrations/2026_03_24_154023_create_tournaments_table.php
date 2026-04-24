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
        $table->string('name'); // This is your 'tournament_name'
        $table->date('start_date');
        $table->date('end_date');
        $table->string('format'); // Singles, Doubles, Mixed
        $table->text('description')->nullable();
        $table->string('image_path')->nullable(); // For posters later
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
