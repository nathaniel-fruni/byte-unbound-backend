<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class AddSponsors extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'GymBeam',
                'logo' => 'gymbeam_logo.png'
            ],
            [
                'name' => 'Ataccama',
                'logo' => 'jetbrains_logo.png'
            ],
            [
                'name' => 'JetBrains',
                'logo' => 'ataccama_logo.png'
            ]
        ];

        foreach ($sponsors as $sponsorData) {
            $sponsor = new Sponsor();
            $sponsor->name = $sponsorData['name'];
            $sponsor->logo = $sponsorData['logo'];
            $sponsor->save();
        }
    }
}
