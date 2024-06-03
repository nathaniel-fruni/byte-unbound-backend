<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TimeSlotController extends Controller
{
    private $fillable_attributes = ["stage_id", "talk_id", "start_time", "end_time"];

    public function getTimeSlots(): JsonResponse {
        $timeSlots = TimeSlot::all();
        return response()->json($timeSlots);
    }

    public function getTimeSlotById(int $id): JsonResponse {
        $timeSlot = TimeSlot::find($id);
        if (!$timeSlot) {
            return response()->json(['message' =>'Time slot not found'], 404);
        }

        return response()->json($timeSlot);
    }

    public function createTimeSlot(Request $request): JsonResponse {
        $timeSlot = new TimeSlot();


        foreach ($this->fillable_attributes as $attribute) {
            $timeSlot->$attribute = $request->input($attribute);
        }
        $timeSlot->save();

        return response()->json($timeSlot);
    }

    public function updateTimeSlot(Request $request, int $id) {
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

    public function deleteTimeSlot($id) {
        $timeSlot = TimeSlot::find($id);
        if (!$timeSlot) {
            return response()->json(['message' => 'Time slot not found'], 404);
        }
        $timeSlot->delete();

        return response()->json(['message' => 'Time slot deleted successfully']);
    }
}
