<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddConferenceOrganizers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyPairs = [
            [
                'conference_id' => 1,
                'organizer_id' => 1,
            ],
            [
                'conference_id' => 1,
                'organizer_id' => 2,
            ],
            [
                'conference_id' => 2,
                'organizer_id' => 1,
            ],
            [
                'conference_id' => 2,
                'organizer_id' => 2,
            ],
            [
                'conference_id' => 3,
                'organizer_id' => 1,
            ],
            [
                'conference_id' => 3,
                'organizer_id' => 2,
            ],
        ];

        foreach ($keyPairs as $pair) {
            DB::table('conference_organizers')->insert($pair);
        }
    }
}
