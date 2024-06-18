<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Speaker;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    private array $fillableAttributes = ['first_name', 'last_name', 'short_description', 'long_description', 'picture', 'linkedin', 'partner_id'];
    private $newestConference;

    public function __construct()
    {
        $this->newestConference = Conference::orderBy('start_date', 'desc')->first();
    }

    public function getSpeakersPublic(): JsonResponse
    {
        $conferenceYear = Carbon::parse($this->newestConference->start_date)->year;

        $timeSlotIds = TimeSlot::whereHas('stage.conferences', function ($query) {
            $query->where('id', $this->newestConference->id);
        })
            ->whereYear('start_time', $conferenceYear)
            ->pluck('id')
            ->toArray();

        $speakers = Speaker::with('partner')
            ->whereHas('talk.timeSlots', function ($query) use ($timeSlotIds) {
                $query->whereIn('id', $timeSlotIds);
            })->get();

        return response()->json($speakers);
    }

    public function getSpeakersAdmin(): JsonResponse
    {
        $conferenceYear = Carbon::parse($this->newestConference->start_date)->year;

        $timeSlotIds = TimeSlot::whereHas('stage.conferences', function ($query) {
            $query->where('id', $this->newestConference->id);
        })
            ->whereYear('start_time', $conferenceYear)
            ->pluck('id')
            ->toArray();

        $speakers = Speaker::with('partner')
            ->whereHas('talk.timeSlots', function ($query) use ($timeSlotIds) {
                $query->whereIn('id', $timeSlotIds);
            })
            ->orWhereDoesntHave('talk.timeSlots')
            ->get();

        return response()->json($speakers);
    }

    public function getSpeakersByConference($conference_id): JsonResponse
    {
        $speakers = Speaker::whereHas('talk.timeSlots.stage.conferences', function ($query) use ($conference_id) {
                $query->where('id', $conference_id);
            })->get();
        return response()->json($speakers);
    }

    public function getSpeakerById($id): JsonResponse
    {
        $speaker = Speaker::with('partner')->find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json($speaker);
    }

    public function createSpeaker(Request $request): JsonResponse
    {
        $speaker = new Speaker();
        foreach ($this->fillableAttributes as $attribute) {
            $speaker->$attribute = $request->input($attribute);
        }

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/speakers'), $imageName);
            $speaker->picture = $imageName;
        }

        $speaker->save();
        $savedSpeaker = Speaker::with('partner')->find($speaker->id);

        return response()->json($savedSpeaker);
    }


    public function updateSpeaker(Request $request, $id): JsonResponse
    {
        $speaker = Speaker::find($id);

        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $speaker->$attribute = $request->input($attribute);
            }
        }

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = $image->hashName();
            $image->move(public_path('storage/images/speakers'), $imageName);
            $speaker->picture = $imageName;
        }

        $speaker->save();
        $savedSpeaker = Speaker::with('partner')->find($speaker->id);

        return response()->json($savedSpeaker);
    }


    public function deleteSpeaker($id): JsonResponse
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }

        $speaker->delete();
        return response()->json(['message' => 'Speaker deleted successfully']);
    }
}
