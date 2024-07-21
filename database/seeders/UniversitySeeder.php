<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('universities')->insert([
            [ 
                'name' => 'UOM',
                'img_url' => 'https://upload.wikimedia.org/wikipedia/en/6/60/University_of_Moratuwa_logo.png'
            ],
            [
                'name' => 'UOP',
                'img_url' => 'https://www.pdn.ac.lk/wp-content/uploads/2022/10/uop-crest.jpg'
            ],
            [
                'name' => 'UOC',
                'img_url' => 'https://law.cmb.ac.lk/wp-content/uploads/2016/06/cropped-logo-1.png'
            ]
    ]);
    }
}
