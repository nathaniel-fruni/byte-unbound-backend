<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AddConferences extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conferences = [
            [
                'title' => 'byteUnbound22',
                'description' => 'Tech konferencia pre študentov v Žiline',
                'start_date' => Carbon::create(2022, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2022, 6, 28, 14, 0, 0),
                'registration_deadline' => Carbon::create(2022, 6, 23, 23, 59, 59),
                'contact_email' => 'info@byteunbound.sk',
                'location_id' => 3,
            ],
            [
                'title' => 'byteUnbound23',
                'description' => 'Tech konferencia pre študentov v Bratislave',
                'start_date' => Carbon::create(2023, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2023, 6, 28, 14, 0, 0),
                'registration_deadline' => Carbon::create(2023, 6, 23, 23, 59, 59),
                'contact_email' => 'info@byteunbound.sk',
                'location_id' => 1,
            ],
            [
                'title' => 'byteUnbound24',
                'description' => 'Tech konferencia pre študentov v Nitre',
                'start_date' => Carbon::create(2024, 6, 25, 9, 0, 0),
                'end_date' => Carbon::create(2024, 6, 28, 14, 0, 0),
                'registration_deadline' => Carbon::create(2024, 6, 23, 23, 59, 59),
                'contact_email' => 'info@byteunbound.sk',
                'location_id' => 2,
            ],
        ];

        foreach ($conferences as $conferenceData) {
            $conference = new Conference();
            $conference->title = $conferenceData['title'];
            $conference->description = $conferenceData['description'];
            $conference->start_date = $conferenceData['start_date'];
            $conference->end_date = $conferenceData['end_date'];
            $conference->registration_deadline = $conferenceData['registration_deadline'];
            $conference->contact_email = $conferenceData['contact_email'];
            $conference->location_id = $conferenceData['location_id'];
            $conference->save();
        }
    }
}
