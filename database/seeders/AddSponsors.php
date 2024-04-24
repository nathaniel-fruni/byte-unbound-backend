<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => '',
                'description' => '',
                'logo' => '+'
            ],
            [
                'name' => '',
                'description' => '',
                'logo' => ''
            ]
        ];
    }
}
