<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    private $fillable_attributes = ["name", "conference_id"];

    public function getGalleries(): JsonResponse {
        $galleries = Gallery::all();
        return response()->json($galleries);
    }

    public function getGalleryById(int $id): JsonResponse {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' =>'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function createGallery(Request $request): JsonResponse {
        $gallery = new Gallery();

        foreach ($this->fillable_attributes as $attribute) {
            $gallery->$attribute = $request->input($attribute);
        }
        $gallery->save();

        return response()->json($gallery);
    }

    public function updateGallery(Request $request, int $id) {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $gallery->$attribute = $request->input($attribute);
            }
        }
        $gallery->save();

        return response()->json($gallery);
    }

    public function deleteGallery($id) {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }
        $gallery->delete();

        return response()->json(['message' => 'Gallery deleted successfully']);
    }
}
