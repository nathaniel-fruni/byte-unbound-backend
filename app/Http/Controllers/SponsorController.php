<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class SponsorController extends Controller
{
    private array $fillable_attributes = ["name", "logo"];

    public function getSponsors(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $sponsors = Sponsor::whereHas('conference', function ($query) use ($newestConference) {
            $query->where('conference_id', $newestConference->id);
        })->get();
        return response()->json($sponsors);
    }

    public function getSponsorById(int $id): JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['message' =>'Sponsor not found'], 404);
        }

        return response()->json($sponsor);
    }

    public function createSponsor(Request $request): JsonResponse
    {
        $sponsor = new Sponsor();

        foreach ($this->fillable_attributes as $attribute) {
            $sponsor->$attribute = $request->input($attribute);
        }
        $sponsor->save();

        return response()->json($sponsor);
    }

    public function updateSponsor(Request $request, int $id): JsonResponse
    {
        $sponsor = Sponsor::find($id);

        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $sponsor->$attribute = $request->input($attribute);
            }
        }
        $sponsor->save();

        return response()->json($sponsor);
    }

    public function deleteSponsor($id): JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }
        $sponsor->delete();

        return response()->json(['message' => 'Sponsor deleted successfully']);
    }
}
