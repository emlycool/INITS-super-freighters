<?php

namespace Database\Seeders;

use App\Models\TransportMode;
use Illuminate\Database\Seeder;

class ShippingDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportMode::where('name', 'air')->first()->duration()->updateOrCreate(['period' => 2]);
        TransportMode::where('name', 'sea')->first()->duration()->updateOrCreate(['period' => 2 * 10]);
    }
}
