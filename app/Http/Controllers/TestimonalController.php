<?php

namespace App\Http\Controllers;

use App\Models\Testimonal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestimonalController extends Controller
{
    private $fillable_attributes = ['name', 'image', 'testimonal_text', 'conference_id'];

    public function getTestimonals(): JsonResponse
    {
        $testimonals = Testimonal::all();
        return response()->json($testimonals);
    }

    public function getTestimonalsByConference($conference_id): JsonResponse
    {
        $testimonals = Testimonal::where('conference_id', $conference_id)->get();
        return response()->json($testimonals);
    }

    public function createTestimonal(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'testimonal_text' => 'required|string',
        ]);

        $testimonal = new Testimonal();
        foreach ($this->fillable_attributes as $attribute) {
            $testimonal->$attribute = $request->input($attribute);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/testimonals'), $imageName);
            $testimonal->image = $imageName;
        }
        $testimonal->save();

        return response()->json($testimonal);
    }

    public function updateTestimonal(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'testimonal_text' => 'required|string',
        ]);

        $testimonal = Testimonal::find($id);

        if (!$testimonal) {
            return response()->json(['message' => 'Testimonal not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $testimonal->$attribute = $request->input($attribute);
            }
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/testimonals'), $imageName);
            $testimonal->image = $imageName;
        }
        $testimonal->save();

        return response()->json($testimonal);
    }

    public function deleteTestimonal($id): JsonResponse
    {
        $testimonal = Testimonal::find($id);
        if (!$testimonal) {
            return response()->json(['message' => 'Testimonal not found'], 404);
        }
        $testimonal->delete();

        return response()->json(['message' => 'Testimonal deleted successfully']);
    }
}
