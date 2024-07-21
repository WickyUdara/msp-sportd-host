<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sports')->insert([
           ['name' => 'Cricket'],
           ['name' => 'Swimming'],
           ['name' => 'Karate'],
           ['name' => 'Badminton'],
           ['name' => 'Beach Volleyball'],
           ['name' => 'Table Tennis'],
           ['name' => 'Kabbadi'],
           ['name' => 'Carrom'],
           ['name' => 'Rugby'],
           ['name' => 'Volleyball'],
           ['name' => 'Road Race'],
           ['name' => 'Basketball'],
           ['name' => 'Hockey'],
           ['name' => 'Football'],
           ['name' => 'Weightlifting'],
           ['name' => 'Rowing'],
           ['name' => 'Taekwondo'],
           ['name' => 'Wrestling'],
           ['name' => 'Netball'],
           ['name' => 'Tennis'],
           ['name' => 'Elle'],
           ['name' => 'Chess'],
           ['name' => 'Baseball'],
           ['name' => 'Track & Field']
        ]);
    }
}
