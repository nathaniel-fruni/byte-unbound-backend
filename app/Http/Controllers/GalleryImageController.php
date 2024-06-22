<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GalleryImageController extends Controller
{
    public function getGalleryImagesByGalleryId($galleryId): JsonResponse
    {
        $images = GalleryImage::where('gallery_id', $galleryId)->get();
        return response()->json($images);
    }
}
