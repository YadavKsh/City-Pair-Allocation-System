<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('city_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_city')->constrained('cities')->onDelete('cascade'); // Ensure it's linked to the cities table
            $table->foreignId('to_city')->constrained('cities')->onDelete('cascade');   // Ensure it's linked to the cities table
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_pairs');
    }
};
