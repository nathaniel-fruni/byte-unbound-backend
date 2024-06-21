<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Stage;
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
            ->orderBy('start_time')
            ->get();

        return response()->json($timeSlots);
    }

    public function getTimeSlotsByStageId($stage_id): JsonResponse
    {
        if (!is_numeric($stage_id) || !Stage::find($stage_id)) {
            return response()->json(['message' => 'Invalid stage_id provided'], 400);
        }

        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        if (!$newestConference) {
            return response()->json(['message' => 'No conferences found'], 404);
        }
        $conferenceYear = Carbon::parse($newestConference->start_date)->year;

        $timeSlots = TimeSlot::with('talk')
            ->whereHas('stage.conferences', function ($query) use ($newestConference) {
                $query->where('id', $newestConference->id);
            })
            ->whereYear('start_time', $conferenceYear)
            ->where('stage_id', $stage_id)
            ->orderBy('start_time')
            ->get();

        return response()->json($timeSlots);
    }

    public function createTimeSlot(Request $request): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $conferenceStartDate = $newestConference->start_date;
        $conferenceEndDate = $newestConference->end_date;

        $startTime = $request->input('start_time.HH') . ':' . $request->input('start_time.mm');
        $endTime = $request->input('end_time.HH') . ':' . $request->input('end_time.mm');
        $start_datetime = date('Y-m-d', strtotime($conferenceStartDate)) . ' ' . $startTime . ':00';
        $end_datetime = date('Y-m-d', strtotime($conferenceStartDate)) . ' ' . $endTime . ':00';

        if ($start_datetime < $conferenceStartDate || $start_datetime >= $conferenceEndDate) {
            return response()->json(['error' => 'Začiatok je skôr ako začiatok konferencie.'], 422);
        }

        if ($end_datetime <= $start_datetime || $end_datetime > $conferenceEndDate) {
            return response()->json(['error' => 'Koniec je neskôr ako koniec konferencie.'], 422);
        }

        $timeSlot = new TimeSlot();
        $timeSlot->start_time = $start_datetime;
        $timeSlot->end_time = $end_datetime;
        $timeSlot->talk_id = $request->input('talk_id');
        $timeSlot->stage_id = $request->input('stage_id');

        $timeSlot->save();
        $savedTimeSlot = TimeSlot::with('talk')->find($timeSlot->id);

        return response()->json($savedTimeSlot);
    }

    public function updateTimeSlot(Request $request, int $id): JsonResponse
    {
        $timeSlot = TimeSlot::findOrFail($id);

        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $conferenceStartDate = $newestConference->start_date;
        $conferenceEndDate = $newestConference->end_date;

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $start_datetime = date('Y-m-d', strtotime($conferenceStartDate)) . ' ' . $startTime . ':00';
        $end_datetime = date('Y-m-d', strtotime($conferenceStartDate)) . ' ' . $endTime . ':00';

        if ($start_datetime < $conferenceStartDate || $start_datetime >= $conferenceEndDate) {
            return response()->json(['error' => 'Začiatok je skôr ako začiatok konferencie.'], 422);
        }

        if ($end_datetime <= $start_datetime || $end_datetime > $conferenceEndDate) {
            return response()->json(['error' => 'Koniec je neskôr ako koniec konferencie.'], 422);
        }

        $timeSlot->start_time = $start_datetime;
        $timeSlot->end_time = $end_datetime;
        $timeSlot->talk_id = $request->input('talk_id');
        $timeSlot->stage_id = $request->input('stage_id');

        $timeSlot->save();
        $updatedTimeSlot = TimeSlot::with('talk')->find($timeSlot->id);

        return response()->json($updatedTimeSlot);
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
