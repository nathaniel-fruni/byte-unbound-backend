<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    private $fillableAttributes = ['image', 'gallery_id'];
    public function getGalleryImages()
    {
        $images = GalleryImage::with('gallery')->get();
        return response()->json($images);
    }
    public function createGalleryImage(Request $request)
    {
        $galleryImage = new GalleryImage();
        foreach ($this->fillableAttributes as $attribute) {
            $galleryImage->$attribute = $request->input($attribute);
        }
        $galleryImage->save();

        return response()->json($galleryImage);
    }
    public function getGalleryImageById($id)
    {
        $galleryImage = GalleryImage::with('gallery')->find($id);

        if (!$galleryImage) {
            return response()->json(['message' => 'Gallery image not found'], 404);
        }

        return response()->json($galleryImage);
    }
    public function updateGalleryImage(Request $request, $id)
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
    public function deleteGalleryImage($id)
    {
        $galleryImage = GalleryImage::find($id);

        if (!$galleryImage) {
            return response()->json(['message' => 'Gallery image not found'], 404);
        }

        $galleryImage->delete();

        return response()->json(['message' => 'Gallery image deleted successfully']);
    }
}
