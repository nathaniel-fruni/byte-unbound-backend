<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    private array $fillable_attributes = ["name", "conference_id"];

    public function getGalleries(): JsonResponse
    {
        $galleries = Gallery::with('gallery_image')->get();
        return response()->json($galleries);
    }

    public function getGalleryByConferenceId($conferenceId): JsonResponse
    {
        $galleries = Gallery::with('gallery_image')
            ->where('conference_id', $conferenceId)
            ->get();
        return response()->json($galleries);
    }


    public function getGalleryById(int $id): JsonResponse
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' =>'Gallery not found'], 404);
        }

        return response()->json($gallery);
    }

    public function createGallery(Request $request): JsonResponse
    {
        $request->validate([
            'conference_id' => 'required|exists:conferences,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $conferenceId = $request->input('conference_id');
        $conference = Conference::findOrFail($conferenceId);
        $year = Carbon::parse($conference->start_date)->year;

        $gallery = Gallery::where('conference_id', $conferenceId)->first();

        if (!$gallery) {
            $gallery = new Gallery();
            $gallery->name = $year;
            $gallery->conference_id = $conferenceId;
            $gallery->save();
        }

        $images = $request->file('images');
        $galleryImages = [];

        foreach ($images as $image) {
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/gallery'), $imageName);

            $galleryImage = new GalleryImage();
            $galleryImage->image = $imageName;
            $galleryImage->gallery_id = $gallery->id;
            $galleryImage->save();

            $galleryImages[] = $galleryImage;
        }

        return response()->json($galleryImages, 201);
    }

    public function updateGallery(Request $request, int $id): JsonResponse
    {
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

    public function deleteGallery($id): JsonResponse
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }
        $gallery->delete();

        return response()->json(['message' => 'Gallery deleted successfully']);
    }
}
