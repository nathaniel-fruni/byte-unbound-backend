<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PartnerController extends Controller
{
    public function getPartners(): JsonResponse
    {
        $newestConference = fetchNewestConference();

        $partners = Partner::whereHas('conference', function ($query) use ($newestConference) {
            $query->where('conference_id', $newestConference->id);
        })->get();

        return response()->json($partners);
    }
}
