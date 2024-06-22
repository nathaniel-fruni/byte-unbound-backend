<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Stage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class StageController extends Controller
{
    private $newestConference;

    public function __construct()
    {
        $this->newestConference = fetchNewestConference();
    }

    public function getStages(): JsonResponse
    {
        $newestConference = $this->newestConference;

        $stages = Stage::whereHas('conferences', function ($query) use ($newestConference) {
            $query->where('conference_id', $newestConference->id);
        })->get();

        return response()->json($stages);
    }

    public function getStagesMetric()
    {
        $previousYearDate = Carbon::parse($this->newestConference->start_date)->subYear();
        $previousYearConference = Conference::whereYear('start_date', $previousYearDate->year)
            ->orderBy('start_date', 'desc')
            ->first();

        $latestConferenceStageCount = $this->newestConference->stages()->count();
        $previousYearConferenceStageCount = $previousYearConference ? $previousYearConference->stages()->count() : 0;

        if ($previousYearConferenceStageCount > 0) {
            $percentageDifference = (($latestConferenceStageCount - $previousYearConferenceStageCount) / $previousYearConferenceStageCount) * 100;
        } else {
            $percentageDifference = $latestConferenceStageCount > 0 ? 100 : 0;
        }

        return response()->json([
            'current_year_unique_stages' => $latestConferenceStageCount,
            'percentage_difference' => round($percentageDifference),
        ]);
    }

    public function createStage(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (!$this->newestConference) {
            return response()->json(['message' => 'No conference found'], 404);
        }

        $stage = new Stage();
        $stage->name = $request->input("name");
        $stage->save();

        $this->newestConference->stages()->attach($stage->id);

        return response()->json($stage);
    }


    public function updateStage(Request $request, int $id):JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

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
