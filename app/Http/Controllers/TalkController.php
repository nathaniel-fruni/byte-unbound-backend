<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Talk;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TalkController extends Controller
{
    private array $fillable_attributes = ["title", "description", "capacity", "remaining_capacity", "speaker_id"];

    public function getTalks(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $conferenceYear = Carbon::parse($newestConference->start_date)->year;

        $timeSlotIds = TimeSlot::whereHas('stage.conferences', function ($query) use ($newestConference) {
            $query->where('id', $newestConference->id);
        })
            ->whereYear('start_time', $conferenceYear)
            ->pluck('id')
            ->toArray();

        $talksWithTimeSlots = Talk::with('speaker')
            ->whereHas('timeSlots', function ($query) use ($timeSlotIds) {
                $query->whereIn('id', $timeSlotIds);
            });

        $talksWithoutTimeSlots = Talk::with('speaker')
            ->doesntHave('timeSlots');

        $talks = $talksWithTimeSlots->union($talksWithoutTimeSlots)->get();

        return response()->json($talks);
    }

    public function getTalksMetric(): JsonResponse
    {
        $latestTimeSlot = TimeSlot::orderBy('start_time', 'desc')->first();

        if (!$latestTimeSlot) {
            return response()->json([
                'current_year_talks' => 0,
                'percentage_difference' => 0,
            ]);
        }

        $latestYear = Carbon::parse($latestTimeSlot->start_time)->year;
        $previousYear = $latestYear - 1;
        $latestYearTalksCount = TimeSlot::whereYear('start_time', $latestYear)
            ->distinct('talk_id')
            ->count('talk_id');
        $previousYearTalksCount = TimeSlot::whereYear('start_time', $previousYear)
            ->distinct('talk_id')
            ->count('talk_id');

        if ($previousYearTalksCount > 0) {
            $percentageDifference = (($latestYearTalksCount - $previousYearTalksCount) / $previousYearTalksCount) * 100;
        } else {
            $percentageDifference = $latestYearTalksCount > 0 ? 100 : 0;
        }

        return response()->json([
            'current_year_talks' => $latestYearTalksCount,
            'percentage_difference' => round($percentageDifference),
        ]);
    }

    public function getTalkById(int $id): JsonResponse
    {
        $talk = Talk::find($id);
        if (!$talk) {
            return response()->json(['message' =>'Talk not found'], 404);
        }

        return response()->json($talk);
    }

    public function createTalk(Request $request): JsonResponse
    {
        $talk = new Talk();

        foreach ($this->fillable_attributes as $attribute) {
            $talk->$attribute = $request->input($attribute);
        }
        $talk->save();
        $savedTalk = Talk::with('speaker')->find($talk->id);

        return response()->json($savedTalk);
    }

    public function updateTalk(Request $request, int $id):JsonResponse
    {
        $talk = Talk::find($id);

        if (!$talk) {
            return response()->json(['message' => 'Talk not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $talk->$attribute = $request->input($attribute);
            }
        }
        $talk->save();
        $savedTalk = Talk::with('speaker')->find($talk->id);

        return response()->json($savedTalk);
    }

    public function deleteTalk($id): JsonResponse
    {
        $talk = Talk::find($id);
        if (!$talk) {
            return response()->json(['message' => 'Talk not found'], 404);
        }
        $talk->delete();

        return response()->json(['message' => 'Talk deleted successfully']);
    }
}
