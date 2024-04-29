<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddConferenceSponsors extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyPairs = [
            [
                'conference_id' => 1,
                'sponsor_id' => 1,
            ],
            [
                'conference_id' => 1,
                'sponsor_id' => 2,
            ],
            [
                'conference_id' => 2,
                'sponsor_id' => 1,
            ],
            [
                'conference_id' => 2,
                'sponsor_id' => 2,
            ],
            [
                'conference_id' => 3,
                'sponsor_id' => 1,
            ],
            [
                'conference_id' => 3,
                'sponsor_id' => 2,
            ],
        ];

        foreach ($keyPairs as $pair) {
            DB::table('conference_sponsors')->insert($pair);
        }
    }
}
