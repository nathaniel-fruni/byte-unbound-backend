<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSpeakerPartners extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyPairs = [
            [
                'partner_id' => 1,
                'speaker_id' => 8,
            ],
            [
                'partner_id' => 9,
                'speaker_id' => 5,
            ],
            [
                'partner_id' => 2,
                'speaker_id' => 2,
            ],
            [
                'partner_id' => 7,
                'speaker_id' => 3,
            ],
            [
                'partner_id' => 8,
                'speaker_id' => 9,
            ],
            [
                'partner_id' => 6,
                'speaker_id' => 7,
            ],
            [
                'partner_id' => 4,
                'speaker_id' => 1,
            ],
            [
                'partner_id' => 10,
                'speaker_id' => 6,
            ],
            [
                'partner_id' => 3,
                'speaker_id' => 4,
            ],
        ];

        foreach ($keyPairs as $pair) {
            DB::table('speaker_partner')->insert($pair);
        }
    }
}
