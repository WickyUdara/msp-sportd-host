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
        Schema::create('table_tennis_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreignId('university_id')->references('uni_id')->on('universities')->onDelete('cascade');
            $table->integer('sets_won')->default(0);
            $table->integer('sets_lost')->default(0);
            $table->integer('set2_marks')->default(-1);
            $table->integer('set1_marks')->default(-1);
            $table->integer('set3_marks')->default(-1);
            $table->integer('set4_marks')->default(-1);
            $table->integer('set5_marks')->default(-1);
            $table->integer('set6_marks')->default(-1);
            $table->integer('set7_marks')->default(-1);
            $table->integer('points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_tennis_scores');
    }
};
