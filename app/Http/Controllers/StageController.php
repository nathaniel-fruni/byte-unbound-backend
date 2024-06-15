<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class StageController extends Controller
{
    public function getStages(): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        $stages = Stage::whereHas('conferences', function ($query) use ($newestConference) {
            $query->where('conference_id', $newestConference->id);
        })->get();

        return response()->json($stages);
    }

    public function getStageById(int $id): JsonResponse
    {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['message' =>'Stage not found'], 404);
        }

        return response()->json($stage);
    }

    public function createStage(Request $request): JsonResponse
    {
        $newestConference = Conference::orderBy('start_date', 'desc')->first();
        if (!$newestConference) {
            return response()->json(['message' => 'No conference found'], 404);
        }

        $stage = new Stage();
        $stage->name = $request->input("name");
        $stage->save();

        $newestConference->stages()->attach($stage->id);

        return response()->json($stage);
    }


    public function updateStage(Request $request, int $id):JsonResponse
    {
        $stage = Stage::find($id);

        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }

        if ($request->has("name")) {
            $stage->name = $request->input("name");
        }
        $stage->save();

        return response()->json($stage);
    }

    public function deleteStage($id): JsonResponse
    {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }
        $stage->conferences()->detach();
        $stage->delete();

        return response()->json(['message' => 'Stage deleted successfully']);
    }

}
