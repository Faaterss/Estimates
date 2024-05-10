<?php

namespace Modules\Estimates\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Estimates\Database\Seeders\EstimatesSeeder;
use Modules\Estimates\Database\Seeders\EstiamtesItemSeeder;

class EstimatesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            EstimatesSeeder::class,
            EstiamtesItemSeeder::class,
        ]);
    }
}
