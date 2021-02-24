<?php

namespace Database\Seeders;

use App\Models\ShippingCountry;
use Illuminate\Database\Seeder;

class ShippingCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingCountry::updateOrCreate(
            ['country_code' => 'US'], 
            [
                'country' => 'United States',
                'flat_rate' => 1.5 * 1000
            ]);

        ShippingCountry::updateOrCreate(
            ['country_code' => 'UK'], 
            [
                'country' => 'United Kingdom',
                'flat_rate' => 0.8 * 1000
            ]);
    }
}
