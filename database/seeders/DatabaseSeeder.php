<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TransportModeSeeder::class);
        $this->call(ShippingCountrySeeder::class);
        $this->call(ShippingCostAggregator::class);
        $this->call(ShippingDurationSeeder::class);
    }
}
