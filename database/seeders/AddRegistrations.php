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
                'user_id' => 3,
                'talk_id' => 3,
                'registered_at' => Carbon::create(2024, 4, 29, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 3,
                'talk_id' => 10,
                'registered_at' => Carbon::create(2024, 4, 29, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 4,
                'talk_id' => 12,
                'registered_at' => Carbon::create(2022, 4, 25, 15, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 5,
                'talk_id' => 11,
                'registered_at' => Carbon::create(2022, 4, 30, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 6,
                'talk_id' => 14,
                'registered_at' => Carbon::create(2023, 5, 15, 15, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 7,
                'talk_id' => 5,
                'registered_at' => Carbon::create(2024, 5, 17, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 7,
                'talk_id' => 4,
                'registered_at' => Carbon::create(2024, 5, 17, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 7,
                'talk_id' => 11,
                'registered_at' => Carbon::create(2022, 5, 17, 18, 0, 0),
                'attended' => true,
            ],
            [
                'user_id' => 7,
                'talk_id' => 12,
                'registered_at' => Carbon::create(2022, 5, 17, 18, 0, 0),
                'attended' => false,
            ],
            [
                'user_id' => 5,
                'talk_id' => 13,
                'registered_at' => Carbon::create(2023, 5, 17, 18, 0, 0),
                'attended' => true,
            ],
            [
                'user_id' => 5,
                'talk_id' => 14,
                'registered_at' => Carbon::create(2023, 5, 17, 18, 0, 0),
                'attended' => true,
            ],
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
