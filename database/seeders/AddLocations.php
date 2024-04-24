<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddLocations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations =["Bratislava", "Nitra", "Žilina"];

        foreach ($locations as $locationName) {
            $location = new Location();
            $location->location = $locationName;
            $location->save();
        }
    }
}
