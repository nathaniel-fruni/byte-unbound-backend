<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddConferenceStages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyPairs = [
            [
                'conference_id' => 1,
                'stage_id' => 1,
            ],
            [
                'conference_id' => 1,
                'stage_id' => 2,
            ],
            [
                'conference_id' => 2,
                'stage_id' => 1,
            ],
            [
                'conference_id' => 2,
                'stage_id' => 2,
            ],
            [
                'conference_id' => 3,
                'stage_id' => 1,
            ],
            [
                'conference_id' => 3,
                'stage_id' => 2,
            ],
        ];

        foreach ($keyPairs as $pair) {
            DB::table('conference_stages')->insert($pair);
        }
    }
}
