<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateKabaddiScoresTable extends Migration
{
    public function up()
    {
        Schema::create('kabaddi_scores', function (Blueprint $table) {
            $table->id('score_id'); // This defines the primary key as score_id
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('uni_id');
            $table->integer('raid_points')->default(0);
            $table->integer('bonus_points')->default(0);
            $table->integer('tackle_points')->default(0);
            $table->integer('all_out_points')->default(0);
            $table->integer('total_score')->default(0);
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER update_total_score BEFORE INSERT ON kabaddi_scores
            FOR EACH ROW
            BEGIN
                SET NEW.total_score = NEW.raid_points + NEW.bonus_points + NEW.all_out_points + NEW.tackle_points;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER update_total_score_before_update BEFORE UPDATE ON kabaddi_scores
            FOR EACH ROW
            BEGIN
                SET NEW.total_score = NEW.raid_points + NEW.bonus_points + NEW.all_out_points + NEW.tackle_points;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_score');
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_score_before_update');
        Schema::dropIfExists('kabaddi_scores');
    }
}