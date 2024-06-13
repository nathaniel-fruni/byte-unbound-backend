<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class OrganizerController extends Controller
{
    private array $fillable_attributes = ["first_name", "last_name", "image", "phone", "email"];

    public function getOrganizers(): JsonResponse
    {
        $organizers = Organizer::all();
        return response()->json($organizers);
    }

    public function getOrganizerById(int $id): JsonResponse
    {
        $organizer = Organizer::find($id);
        if (!$organizer) {
            return response()->json(['message' =>'Organizer not found'], 404);
        }

        return response()->json($organizer);
    }

    public function createOrganizer(Request $request): JsonResponse
    {
        $organizer = new Organizer();

        foreach ($this->fillable_attributes as $attribute) {
            $organizer->$attribute = $request->input($attribute);
        }
        $organizer->save();

        return response()->json($organizer);
    }

    public function updateOrganizer(Request $request, int $id): JsonResponse
    {
        $organizer = Organizer::find($id);

        if (!$organizer) {
            return response()->json(['message' => 'Organizer not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $organizer->$attribute = $request->input($attribute);
            }
        }
        $organizer->save();

        return response()->json($organizer);
    }

    public function deleteOrganizer($id): JsonResponse
    {
        $organizer = Organizer::find($id);
        if (!$organizer) {
            return response()->json(['message' => 'Organizer not found'], 404);
        }
        $organizer->delete();

        return response()->json(['message' => 'Organizer deleted successfully']);
    }
}
