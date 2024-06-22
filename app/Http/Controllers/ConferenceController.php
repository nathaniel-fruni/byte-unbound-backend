<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ConferenceController extends Controller
{
    public function getConferences(): JsonResponse
    {
        $conferences = Conference::with(['address'])->get();
        return response()->json($conferences);
    }

    public function getNewestConferenceWithAddress(): JsonResponse
    {
        $conference = Conference::with(['address'])->orderBy('id', 'desc')->first();

        if (!$conference) {
            return response()->json(['message' => 'Conference not found'], 404);
        }

        return response()->json($conference);
    }
}

