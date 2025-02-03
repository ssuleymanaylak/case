<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YukatechtestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('locations')->insert([
            [
                'name' => 'Eiffel Tower',
                'latitude' => 48.8584,
                'longitude' => 2.2945,
                'color' => '#FF5733',
            ],
            [
                'name' => 'Statue of Liberty',
                'latitude' => 40.6892,
                'longitude' => -74.0445,
                'color' => '#33FF57',
            ],
            [
                'name' => 'Great Wall of China',
                'latitude' => 40.4319,
                'longitude' => 116.5704,
                'color' => '#3357FF',
            ],
        ]);
    }
}
