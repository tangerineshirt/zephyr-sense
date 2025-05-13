<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class AirSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $statuses = ['Good', 'Moderate', 'Poor', 'Hazardous'];

        for ($i = 0; $i < 5; $i++) {
            DB::table('airs')->insert([
                'pm25'        => $faker->randomFloat(2, 0, 300),
                'co'          => $faker->randomFloat(2, 0, 20),
                'no2'         => $faker->randomFloat(2, 0, 200),
                'temp'        => $faker->randomFloat(1, -10, 50),
                'humidity'    => $faker->randomFloat(1, 10, 100),
                'air_quality' => $faker->randomElement($statuses),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}