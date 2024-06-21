<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AddTimeSlots extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeSlots = [
            [
                'stage_id' => 1,
                'talk_id' => 6,
                'start_time' => Carbon::create(2024, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 9, 45, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 7,
                'start_time' => Carbon::create(2024, 6, 25, 13, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 13, 45, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 8,
                'start_time' => Carbon::create(2024, 6, 25, 10, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 10, 45, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 9,
                'start_time' => Carbon::create(2024, 6, 25, 10, 45, 0),
                'end_time' => Carbon::create(2024, 6, 28, 11, 30, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 10,
                'start_time' => Carbon::create(2024, 6, 25, 11, 45, 0),
                'end_time' => Carbon::create(2024, 6, 28, 12, 30, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 1,
                'start_time' => Carbon::create(2024, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 9, 45, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 2,
                'start_time' => Carbon::create(2024, 6, 25, 13, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 13, 45, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 3,
                'start_time' => Carbon::create(2024, 6, 25, 10, 0, 0),
                'end_time' => Carbon::create(2024, 6, 28, 10, 45, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 4,
                'start_time' => Carbon::create(2024, 6, 25, 10, 45, 0),
                'end_time' => Carbon::create(2024, 6, 28, 11, 30, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 5,
                'start_time' => Carbon::create(2024, 6, 25, 11, 45, 0),
                'end_time' => Carbon::create(2024, 6, 28, 12, 30, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 11,
                'start_time' => Carbon::create(2022, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2022, 6, 28, 9, 45, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 12,
                'start_time' => Carbon::create(2022, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2022, 6, 28, 9, 45, 0),
            ],
            [
                'stage_id' => 1,
                'talk_id' => 13,
                'start_time' => Carbon::create(2023, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2023, 6, 28, 9, 45, 0),
            ],
            [
                'stage_id' => 2,
                'talk_id' => 14,
                'start_time' => Carbon::create(2023, 6, 25, 9, 0, 0),
                'end_time' => Carbon::create(2023, 6, 28, 9, 45, 0),
            ],
        ];

        foreach ($timeSlots as $timesSlotData) {
            $timeSlot = new TimeSlot();
            $timeSlot->stage_id = $timesSlotData['stage_id'];
            $timeSlot->talk_id = $timesSlotData['talk_id'];
            $timeSlot->start_time = $timesSlotData['start_time'];
            $timeSlot->end_time = $timesSlotData['end_time'];
            $timeSlot->save();
        }
    }
}
