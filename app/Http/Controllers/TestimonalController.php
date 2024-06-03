<?php

namespace App\Http\Controllers;

use App\Models\Testimonal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestimonalController extends Controller
{
    private $fillable_attributes = ['name', 'image', 'testimonal_text', 'conference_id'];

    public function getTestimonals(): JsonResponse {
        $testimonals = Testimonal::all();
        return response()->json($testimonals);
    }

    public function getTestimonalById(int $id): JsonResponse {
        $testimonal = Testimonal::find($id);
        if (!$testimonal) {
            return response()->json(['message' =>'Testimonal not found'], 404);
        }

        return response()->json($testimonal);
    }

    public function createTestimonal(Request $request): JsonResponse {
        $testimonal = new Testimonal();

        foreach ($this->fillable_attributes as $attribute) {
            $testimonal->$attribute = $request->input($attribute);
        }
        $testimonal->save();

        return response()->json($testimonal);
    }

    public function updateTestimonal(Request $request, int $id) {
        $testimonal = Testimonal::find($id);

        if (!$testimonal) {
            return response()->json(['message' => 'Testimonal not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $testimonal->$attribute = $request->input($attribute);
            }
        }
        $testimonal->save();

        return response()->json($testimonal);
    }

    public function deleteTestimonal($id) {
        $testimonal = Testimonal::find($id);
        if (!$testimonal) {
            return response()->json(['message' => 'Testimonal not found'], 404);
        }
        $testimonal->delete();

        return response()->json(['message' => 'Testimonal deleted successfully']);
    }
}
