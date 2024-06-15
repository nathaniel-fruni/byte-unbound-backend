<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Talk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TalkController extends Controller
{
    private array $fillable_attributes = ["title", "description", "capacity", "remaining_capacity", "speaker_id"];

    public function getTalks(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $talks = Talk::whereHas('timeSlots.stage.conferences', function ($query) use ($newestConference) {
            $query->where('conference_id', $newestConference->id);
        })->get();

        return response()->json($talks);
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

        return response()->json($talk);
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

        return response()->json($talk);
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
