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
        Schema::create('cricket_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreignId('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
            $table->enum('current_role', ['bat', 'ball', 'none'])->default('none');
            $table->integer('runs')->default(0);
            $table->integer('n_6s')->default(0);
            $table->integer('n_4s')->default(0);
            $table->integer('wide_balls')->default(0); 
            $table->integer('no_balls')->default(0);
            $table->integer('wickets')->default(0);
            $table->integer('innings')->default(0);
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
        Schema::dropIfExists('cricket_scores');
    }
};
