<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Air;

class AirSeeder extends Seeder
{
    public function run(): void
    {
        $qualities = ['Good', 'Moderate', 'Poor', 'Hazardous'];

        for ($i = 0; $i < 5; $i++) {
            Air::create([
                'pm25' => fake()->randomFloat(2, 0, 200),
                'co' => fake()->randomFloat(2, 0, 10),
                'no2' => fake()->randomFloat(2, 0, 100),
                'temp' => fake()->randomFloat(1, 15, 40),
                'humidity' => fake()->randomFloat(1, 30, 90),
                'air_quality' => $qualities[array_rand($qualities)],
            ]);
        }
    }
}