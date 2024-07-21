<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tournaments')->insert([
            [ 'name' => 'SLUG 19',

             ]
         ,[
             'name' => 'SLUG 23',
         ]
         ]);
    }
}
