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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('watering_interval');
            $table->string('sunlight_interval');
            $table->string('fertilized_interval');
            $table->string('last_watered');
            $table->string('next_watering');
            $table->string('last_sunlight');
            $table->string('next_sunlight');
            $table->string('last_fertilized');
            $table->string('next_fertilizing');
            $table->string('image');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
