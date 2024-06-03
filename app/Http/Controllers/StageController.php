<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class StageController extends Controller
{
    public function getStages(): JsonResponse {
        $stages = Stage::all();
        return response()->json($stages);
    }

    public function getStageById(int $id): JsonResponse {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['message' =>'Stage not found'], 404);
        }

        return response()->json($stage);
    }

    public function createStage(Request $request): JsonResponse {
        $stage = new Stage();

        $stage->name = $request->input("name");
        $stage->save();

        return response()->json($stage);
    }

    public function updateStage(Request $request, int $id) {
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

    public function deleteStage($id) {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['message' => 'Stage not found'], 404);
        }
        $stage->delete();

        return response()->json(['message' => 'Stage deleted successfully']);
    }
}
