<?php

namespace Modules\Estimates\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EstiamtesItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $units = ['kg', 'm^2', 'm^3', 'liter'];

        for ($i = 1; $i <= 5; $i++) {
            DB::table('estimate_items')->insert([
                'title' => 'Item ' . $i,
                'estimate_id' => 1,
                'unit_id' => $units[array_rand($units)], // Randomly select a unit from the array
                'unit_value' => round(rand(100, 10000) / 1000, 3),
                'work_cost' => rand(500, 5000),
                'work_quantity' => rand(1, 10),
                'resource_cost' => rand(300, 3000), // Add material cost column
                'mechanical_cost' => rand(200, 2000),
                'other_cost' => rand(100, 2000), // Add other cost column
                'total_cost' => rand(1000, 10000)
            ]);
        }
    }
}
