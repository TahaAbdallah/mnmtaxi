<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trip;
use Faker\Factory as Faker;
use App\Models\Driver;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

          // Get all existing drivers
          $drivers = Driver::all();

       // Generate more than 50 random trips
       for ($i = 0; $i < 50; $i++) {
            // Choose a random driver from the existing drivers
            $driver = $drivers->random();

            Trip::create([
                'client_name' => $faker->name,
                'client_phone_number' => $faker->unique()->numerify('07########'),
                'location' => $faker->address,
                'destination' => $faker->city,
                'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'time' => $faker->time(),
                'details' => $faker->sentence,
                'driver_id' => $driver->id,
                'status' => 'pending', // Or you can generate random status if needed
            ]);
        }
    }
}