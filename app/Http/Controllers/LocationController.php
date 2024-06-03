<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    public function getLocations(): JsonResponse {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function getLocationById(int $id): JsonResponse {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['message' =>'Location not found'], 404);
        }

        return response()->json($location);
    }

    public function createLocation(Request $request): JsonResponse {
        $location = new Location();

        $location->location = $request->input("location");
        $location->save();

        return response()->json($location);
    }

    public function updateLocation(Request $request, int $id) {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }

        if ($request->has("location")) {
            $location->location = $request->input("location");
        }
        $location->save();

        return response()->json($location);
    }

    public function deleteLocation($id) {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }
        $location->delete();

        return response()->json(['message' => 'Location deleted successfully']);
    }
}
