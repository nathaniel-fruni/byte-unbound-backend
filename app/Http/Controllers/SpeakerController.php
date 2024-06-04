<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    private $fillableAttributes = ['first_name', 'last_name', 'short_description', 'long_description', 'picture', 'linkedin', 'partner_id'];

    public function getSpeakers() {
        $speakers  = Speaker::with('partner')->get();
        return response()->json($speakers);
    }

    public function createSpeaker(Request $request) {
        $speaker = new Speaker();
        foreach ($this->fillableAttributes as $attribute) {
            $speaker->$attribute = $request->input($attribute);
        }
        $speaker->save();

        return response()->json($speaker);
    }

    public function getSpeakerById($id) {
        $speaker = Speaker::with('partner')->find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json($speaker);
    }

    public function updateSpeaker(Request $request, $id)
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

    public function deleteSpeaker($id) {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        $speaker->delete();
        return response()->json(['message' => 'Speaker deleted successfully']);
    }
}
