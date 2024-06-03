<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Faker\Factory as Faker;

class DriversTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Generate more than 50 random drivers
        for ($i = 0; $i < 50; $i++) {
            Driver::create([
                'name' => $faker->name,
                'driverPhoneNumber' => $faker->unique()->numerify('03########'),
                // Add latitude and longitude if needed
            ]);
        }
}
}