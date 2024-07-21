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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('name');
            $table->enum('status', ['live', 'past', 'upcoming']);
            $table->string('livestream_link')->nullable();
            $table->date('event_date');
            $table->enum('winning_status', ['won', 'drawn', 'cancelled','ongoing','notstarted'])->nullable();
            $table->unsignedBigInteger('winner_uni_id')->nullable();
            $table->foreignId('sport_id')->references('sport_id')->on('sports');
            $table->foreignId('category_id')->references('category_id')->on('categories');
            $table->foreignId('tournament_id')->references('tournament_id')->on('tournaments');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
