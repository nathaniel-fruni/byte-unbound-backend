<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;

class AddOrganizers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizers = [
            [
                'first_name' => 'Dominik',
                'last_name' => 'Halvoník',
                'image' => 'halvonik.jpg',
                'phone' => '+421902170744',
                'email' => 'dhalvonik@ukf.sk'
            ],
            [
                'first_name' => 'Jaroslav',
                'last_name' => 'Reichel',
                'image' => 'reichel.jpg',
                'phone' => '+421904687757',
                'email' => 'jreichel@ukf.sk'
            ]
        ];

        foreach ($organizers as $organizerData) {
            $organizer = new Organizer();
            $organizer->first_name = $organizerData['first_name'];
            $organizer->last_name = $organizerData['last_name'];
            $organizer->image = $organizerData['image'];
            $organizer->phone = $organizerData['phone'];
            $organizer->email = $organizerData['email'];
            $organizer->save();
        }
    }
}
