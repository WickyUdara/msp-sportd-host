<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use SebastianBergmann\Type\NullType;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'name' => 'Event1',
                'status'=>'live',
                'livestream_link'=>'',
                'event_date'=>'2024-06-10',
                'winner_uni_id'=>NULL,
                'sport_id'=>'4',
                'category_id'=>'2',
                'tournament_id'=>'2',
            ],
            [
                'name' => 'Event2',
                'status'=>'past',
                'livestream_link'=>'',
                'event_date'=>'2024-06-08',
                'winner_uni_id'=>NULL,
                'sport_id'=>'5',
                'category_id'=>'2',
                'tournament_id'=>'2',
            ],
            [
                'name' => 'Event3',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'3',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event4',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'1',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event5',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'2',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event6',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'6',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event7',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'7',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event8',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'8',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event9',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'9',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event10',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'14',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event11',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'12',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event12',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'11',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event13',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'13',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event14',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'17',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event15',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'18',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event16',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'22',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
            [
                'name' => 'Event16',
                'status'=>'upcoming',
                'livestream_link'=>'',
                'event_date'=>'2024-06-21',
                'winner_uni_id'=>NULL,
                'sport_id'=>'10',
                'category_id'=>'1',
                'tournament_id'=>'1',

            ],
        ]);

        //************* Participant Teams */

        DB::table('event_participants')->insert([
            //===================== (Event 1)
            [
                'event_id' => '1',
                'uni_id' => '1'
            ],
            [
                'event_id' => '1',
                'uni_id' => '2'
            ],
            //===================== (Event 2)
            [
                'event_id' => '2',
                'uni_id' => '1'
            ],
            [
                'event_id' => '2',
                'uni_id' => '2'
            ],
            //===================== (Event 3)
            [
                'event_id' => '3',
                'uni_id' => '1'
            ],
            [
                'event_id' => '3',
                'uni_id' => '2'
            ],
            //===================== (Event 4)
            [
                'event_id' => '4',
                'uni_id' => '1'
            ],
            [
                'event_id' => '4',
                'uni_id' => '2'
            ],
            //===================== (Event 5)
            [
                'event_id' => '5',
                'uni_id' => '1'
            ],
            [
                'event_id' => '5',
                'uni_id' => '2'
            ],
            [
                'event_id' => '5',
                'uni_id' => '3'
            ],
            //===================== (Event 6)
            [
                'event_id' => '6',
                'uni_id' => '1'
            ],
            [
                'event_id' => '6',
                'uni_id' => '2'
            ],
            //===================== (Event 7)
            [
                'event_id' => '7',
                'uni_id' => '1'
            ],
            [
                'event_id' => '7',
                'uni_id' => '2'
            ],
            [
                'event_id' => '8',
                'uni_id' => '1'
            ],
            [
                'event_id' => '8',
                'uni_id' => '2'
            ],
            //===================== (Event 9)
            [
                'event_id' => '9',
                'uni_id' => '1'
            ],
            [
                'event_id' => '9',
                'uni_id' => '2'
            ],
            //===================== (Event 10)
            [
                'event_id' => '10',
                'uni_id' => '1'
            ],
            [
                'event_id' => '10',
                'uni_id' => '2'
            ],
            //===================== (Event 11)
            [
                'event_id' => '11',
                'uni_id' => '1'
            ],
            [
                'event_id' => '11',
                'uni_id' => '2'
            ],
            //===================== (Event 12)
            [
                'event_id' => '12',
                'uni_id' => '1'
            ],
            [
                'event_id' => '12',
                'uni_id' => '2'
            ],
            [
                'event_id' => '12',
                'uni_id' => '3'
            ],
            //===================== (Event 13)
            [
                'event_id' => '13',
                'uni_id' => '1'
            ],
            [
                'event_id' => '13',
                'uni_id' => '2'
            ],
            //===================== (Event 14)
            [
                'event_id' => '14',
                'uni_id' => '1'
            ],
            [
                'event_id' => '14',
                'uni_id' => '2'
            ],
            //===================== (Event 15)
            [
                'event_id' => '15',
                'uni_id' => '1'
            ],
            [
                'event_id' => '15',
                'uni_id' => '2'
            ],
            //===================== (Event 16)
            [
                'event_id' => '16',
                'uni_id' => '1'
            ],
            [
                'event_id' => '16',
                'uni_id' => '2'
            ],
            //===================== (Event 17)
            [
                'event_id' => '17',
                'uni_id' => '1'
            ],
            [
                'event_id' => '17',
                'uni_id' => '2'
            ],
        ]);
    }
}
