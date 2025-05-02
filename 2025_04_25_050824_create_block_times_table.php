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
        Schema::create('block_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_pair_id')->constrained('city_pairs')->onDelete('cascade');
            $table->string('duration');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_times');
    }
};
