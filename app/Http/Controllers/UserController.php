<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function getUsersByConference($conference_id): JsonResponse
    {
        $conference = Conference::findOrFail($conference_id);
        $conferenceYear = Carbon::parse($conference->start_date)->year;

        $users = User::whereHas('registration', function ($query) use ($conferenceYear) {
            $query->whereYear('registered_at', $conferenceYear);
        })->with(['registration' => function ($query) use ($conferenceYear) {
            $query->whereYear('registered_at', $conferenceYear);
            $query->with('talk');
        }])->get();

        return response()->json($users);
    }
}
