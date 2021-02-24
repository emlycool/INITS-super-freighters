<?php

namespace Database\Seeders;

use App\Models\TransportMode;
use Illuminate\Database\Seeder;

class ShippingCostAggregator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportMode::where('name', 'air')->first()->costAggregator()
                    ->updateOrCreate([
                        'base_cost' => 50 * 1000,
                        'cost_per_kg' => 10 * 1000
                    ]);

        TransportMode::where('name', 'sea')->first()->costAggregator()
        ->updateOrCreate([
            'base_cost' => 15 * 1000,
            'cost_per_kg' => 2 * 1000
        ]);
    }
}
