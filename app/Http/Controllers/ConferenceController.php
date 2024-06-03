<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    private $fillableAttributes = ['title', 'description', 'start_date', 'end_date', 'registration_deadline', 'contact_email', 'location_id', 'address_id'];
    public function getConferences()
    {
        $conferences = Conference::with(['location', 'address'])->get();
        return response()->json($conferences);
    }
    public function createConference(Request $request)
    {
        $conference = new Conference();
        foreach ($this->fillableAttributes as $attribute) {
            $conference->$attribute = $request->input($attribute);
        }
        $conference->save();

        return response()->json($conference);
    }
    public function getConference($id)
    {
        $conference = Conference::with(['location', 'address'])->find($id);

        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        return response()->json($conference);
    }
    public function updateConference(Request $request, $id)
    {
        $conference = Conference::find($id);

        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }



        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $conference->$attribute = $request->input($attribute);
            }
        }

        $conference->save();

        return response()->json($conference);
    }
    public function deleteConference($id)
    {
        $conference = Conference::find($id);

        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        $conference->delete();

        return response()->json(['message' => 'Conference deleted successfully']);
    }


}

