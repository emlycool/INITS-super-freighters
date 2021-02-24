<?php

namespace Database\Seeders;

use App\Models\TransportMode;
use Illuminate\Database\Seeder;

class TransportModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $byAir  = TransportMode::firstOrCreate(
            ['name' => 'air']
        );
        $bySea  = TransportMode::firstOrCreate(
            ['name' => 'sea']
        );
    }
}
