<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OrganizerController extends Controller
{
    public function getOrganizers(): JsonResponse
    {
        $organizers = Organizer::all();
        return response()->json($organizers);
    }
}
