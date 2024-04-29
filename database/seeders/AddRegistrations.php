<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AddRegistrations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = [
            [
                'user_id' => 3,
                'talk_id' => 6,
                'registered_at' => Carbon::create(2024, 4, 29, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 4,
                'talk_id' => 1,
                'registered_at' => Carbon::create(2024, 4, 25, 15, 0, 0),
                'attended' => false,
            ]
        ];

        foreach ($registrations as $registrationData) {
            $registration = new Registration();
            $registration->user_id = $registrationData['user_id'];
            $registration->talk_id = $registrationData['talk_id'];
            $registration->registered_at = $registrationData['registered_at'];
            $registration->attended = $registrationData['attended'];
            $registration->save();
        }
    }
}
