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
        Schema::create('swimming_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreignId('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
            $table->integer('place')->default(0);
            $table->integer('points')->default(0);
            //... [balls, overs, score] are automatically calculating in CricketScore model
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swimming_scores');
    }
};
