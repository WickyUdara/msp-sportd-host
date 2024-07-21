<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hockey_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreignId('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
            $table->integer('goals')->default(0);
            $table->integer('shots')->default(0);
            $table->integer('circle_penetrations')->default(0);
            $table->integer('penalty_corners')->default(0);
            $table->integer('green_cards')->default(0);
            $table->integer('yellow_cards')->default(0);
            $table->integer('red_cards')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hockey_scores');
    }
};
