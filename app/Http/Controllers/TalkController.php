<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TalkController extends Controller
{
    private $fillable_attributes = ["title", "description", "capacity", "speaker_id"];

    public function getTalks(): JsonResponse {
        $talks = Talk::all();
        return response()->json($talks);
    }

    public function getTalkById(int $id): JsonResponse {
        $talk = Talk::find($id);
        if (!$talk) {
            return response()->json(['message' =>'Talk not found'], 404);
        }

        return response()->json($talk);
    }

    public function createTalk(Request $request): JsonResponse {
        $talk = new Talk();

        foreach ($this->fillable_attributes as $attribute) {
            $talk->$attribute = $request->input($attribute);
        }
        $talk->save();

        return response()->json($talk);
    }

    public function updateTalk(Request $request, int $id) {
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

    public function deleteTalk($id) {
        $talk = Talk::find($id);
        if (!$talk) {
            return response()->json(['message' => 'Talk not found'], 404);
        }
        $talk->delete();

        return response()->json(['message' => 'Talk deleted successfully']);
    }
}
