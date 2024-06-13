<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    private array $fillableAttributes = ['image', 'gallery_id'];

    public function getGalleryImages(): JsonResponse
    {
        $images = GalleryImage::with('gallery')->get();
        return response()->json($images);
    }

    public function getGalleryImagesByGalleryId($galleryId): JsonResponse
    {
        $images = GalleryImage::where('gallery_id', $galleryId)->get();
        return response()->json($images);
    }

    public function createGalleryImage(Request $request): JsonResponse
    {
        $galleryImage = new GalleryImage();
        foreach ($this->fillableAttributes as $attribute) {
            $galleryImage->$attribute = $request->input($attribute);
        }
        $galleryImage->save();

        return response()->json($galleryImage);
    }

    public function getGalleryImageById($id): JsonResponse
    {
        $galleryImage = GalleryImage::with('gallery')->find($id);

        if (!$galleryImage) {
            return response()->json(['message' => 'Gallery image not found'], 404);
        }

        return response()->json($galleryImage);
    }

    public function updateGalleryImage(Request $request, $id): JsonResponse
    {
        $galleryImage = GalleryImage::find($id);

        if (!$galleryImage) {
            return response()->json(['message' => 'Gallery image not found'], 404);
        }

        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $galleryImage->$attribute = $request->input($attribute);
            }
        }

        $galleryImage->save();

        return response()->json($galleryImage);
    }

    public function deleteGalleryImage($id): JsonResponse
    {
        $galleryImage = GalleryImage::find($id);

        if (!$galleryImage) {
            return response()->json(['message' => 'Gallery image not found'], 404);
        }

        $galleryImage->delete();

        return response()->json(['message' => 'Gallery image deleted successfully']);
    }
}
