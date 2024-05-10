<?php

namespace Modules\Estimates\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EstimatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate fake data and insert into the database
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => 'EST-' . $faker->unique()->randomNumber(5),
                'client_id' => $faker->numberBetween(1, 10),
                'employee_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['draft', 'sent', 'approved', 'rejected']),
                'position_count' => $faker->numberBetween(1, 10),
                'in_total' => $faker->randomFloat(2, 100, 1000),
                'tax' => $faker->randomFloat(2, 0, 100),
                'discount' => $faker->randomFloat(2, 0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert generated data into the database
        DB::table('estimates')->insert($data);
    }
}