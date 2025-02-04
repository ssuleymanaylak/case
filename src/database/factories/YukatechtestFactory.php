<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Yukatechtest;

class YukatechtestFactory extends Factory
{
    protected $model = Yukatechtest::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'color' => $this->faker->hexColor,
        ];
    }
}
