<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TimeSlotController extends Controller
{
    private array $fillable_attributes = ["stage_id", "talk_id", "start_time", "end_time"];

    public function getTimeSlots(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $conferenceYear = Carbon::parse($newestConference->start_date)->year;

        $timeSlots = TimeSlot::with('stage', 'talk.speaker.partner')
            ->whereHas('stage.conferences', function ($query) use ($newestConference) {
                $query->where('id', $newestConference->id);
            })
            ->whereYear('start_time', $conferenceYear)
            ->get();

        return response()->json($timeSlots);
    }

    public function getTimeSlotById(int $id): JsonResponse
    {
        $timeSlot = TimeSlot::find($id);
        if (!$timeSlot) {
            return response()->json(['message' =>'Time slot not found'], 404);
        }

        return response()->json($timeSlot);
    }

    public function createTimeSlot(Request $request): JsonResponse
    {
        $timeSlot = new TimeSlot();


        foreach ($this->fillable_attributes as $attribute) {
            $timeSlot->$attribute = $request->input($attribute);
        }
        $timeSlot->save();

        return response()->json($timeSlot);
    }

    public function updateTimeSlot(Request $request, int $id): JsonResponse
    {
        $timeSlot = TimeSlot::find($id);

        if (!$timeSlot) {
            return response()->json(['message' => 'Time slot not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $timeSlot->$attribute = $request->input($attribute);
            }
        }
        $timeSlot->save();

        return response()->json($timeSlot);
    }

    public function deleteTimeSlot($id): JsonResponse
    {
        $timeSlot = TimeSlot::find($id);
        if (!$timeSlot) {
            return response()->json(['message' => 'Time slot not found'], 404);
        }
        $timeSlot->delete();

        return response()->json(['message' => 'Time slot deleted successfully']);
    }
}
