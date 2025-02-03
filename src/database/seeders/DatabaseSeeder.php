<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User1',
            'email' => 'test1@example.com',
        ]);
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
