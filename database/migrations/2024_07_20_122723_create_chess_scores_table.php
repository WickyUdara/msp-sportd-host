<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chess_scores', function (Blueprint $table) {
            $table->id('score_id');
            $table->foreignId('event_id')->constrained('events', 'event_id')->onDelete('cascade');
            $table->foreignId('university_id')->constrained('universities', 'uni_id')->onDelete('cascade');
            $table->decimal('match_1_score', 3, 1)->default(0);
            $table->decimal('match_2_score', 3, 1)->default(0);
            $table->decimal('match_3_score', 3, 1)->default(0);
            $table->decimal('match_4_score', 3, 1)->default(0);
            $table->decimal('match_5_score', 3, 1)->default(0);
            $table->decimal('match_6_score', 3, 1)->default(0);
            $table->decimal('total_score', 3, 1)->default(0);
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER calculate_total_score_before_insert
            BEFORE INSERT ON chess_scores
            FOR EACH ROW
            BEGIN
                SET NEW.total_score = NEW.match_1_score + NEW.match_2_score + NEW.match_3_score +
                                     NEW.match_4_score + NEW.match_5_score + NEW.match_6_score;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER calculate_total_score_before_update
            BEFORE UPDATE ON chess_scores
            FOR EACH ROW
            BEGIN
                SET NEW.total_score = NEW.match_1_score + NEW.match_2_score + NEW.match_3_score +
                                     NEW.match_4_score + NEW.match_5_score + NEW.match_6_score;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_total_score_before_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_total_score_before_update');
        Schema::dropIfExists('chess_scores');
    }
};
