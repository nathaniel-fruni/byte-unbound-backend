<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddConferencePartners extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyPairs = [
            [
                'conference_id' => 3,
                'partner_id' => 1,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 2,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 3,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 4,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 5,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 6,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 7,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 8,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 9,
            ],
            [
                'conference_id' => 3,
                'partner_id' => 10,
            ],
        ];

        foreach ($keyPairs as $pair) {
            DB::table('conference_partners')->insert($pair);
        }
    }
}
