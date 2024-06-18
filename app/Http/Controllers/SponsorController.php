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
    private $newestConference;

    public function __construct()
    {
        $this->newestConference = Conference::orderBy('start_date', 'desc')->first();
    }

    public function getSponsors(): JsonResponse
    {
        $sponsors = Sponsor::whereHas('conference', function ($query) {
            $query->where('conference_id', $this->newestConference->id);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/sponsors'), $imageName);

            $sponsor = new Sponsor();
            $sponsor->name = $request->name;
            $sponsor->logo = $imageName;
            $sponsor->save();

            if ($this->newestConference) {
                $sponsor->conference()->attach($this->newestConference->id);
            }

            return response()->json($sponsor, 201);
        }

        return response()->json(['error' => 'Image upload failed.'], 500);
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
