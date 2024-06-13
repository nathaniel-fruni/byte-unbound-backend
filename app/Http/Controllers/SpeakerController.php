<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Speaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    private array $fillableAttributes = ['first_name', 'last_name', 'short_description', 'long_description', 'picture', 'linkedin', 'partner_id'];

    public function getSpeakers(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $speakers = Speaker::with('partner')
            ->whereHas('talk.timeSlots.stage.conferences', function ($query) use ($newestConference) {
                $query->where('id', $newestConference->id);
            })->get();

        return response()->json($speakers);
    }

    public function getSpeakersByConference($conference_id): JsonResponse
    {
        $speakers = Speaker::whereHas('talk.timeSlots.stage.conferences', function ($query) use ($conference_id) {
                $query->where('id', $conference_id);
            })->get();
        return response()->json($speakers);
    }

    public function getSpeakerById($id): JsonResponse
    {
        $speaker = Speaker::with('partner')->find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json($speaker);
    }

    public function createSpeaker(Request $request): JsonResponse
    {
        $speaker = new Speaker();
        foreach ($this->fillableAttributes as $attribute) {
            $speaker->$attribute = $request->input($attribute);
        }
        $speaker->save();

        return response()->json($speaker);
    }

    public function updateSpeaker(Request $request, $id):JsonResponse
    {
        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $speaker->$attribute = $request->input($attribute);
            }
        }

        $speaker->save();

        return response()->json($speaker);
    }

    public function deleteSpeaker($id): JsonResponse
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        $speaker->delete();
        return response()->json(['message' => 'Speaker deleted successfully']);
    }
}
