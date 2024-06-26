<?php

namespace App\Http\Controllers;

use App\Mail\OrganizerNotification;
use App\Mail\RegistrationSuccessful;
use App\Mail\UnregisteredSuccessfully;
use App\Models\Conference;
use App\Models\Registration;
use App\Models\Talk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function register(Request $request) : JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'talk_ids' => 'required|string',
        ]);

        $email = $request->input('email');

        DB::beginTransaction();

        try {
            $userExists = User::where('email', $email)->exists();

            if ($userExists) {
                return response()->json(['message' => 'Registrácia pre daný email už existuje.'], 409);
            }

            $talkIdsJson = $request->input('talk_ids');
            $talkIds = json_decode($talkIdsJson, true);
            if (!is_array($talkIds)) {
                DB::rollBack();
                return response()->json(['message' => 'Invalid input for talk_ids'], 400);
            }
            $talks = Talk::with('timeSlots')->whereIn('id', $talkIds)->get();

            foreach ($talks as $talk) {
                if ($talk->remaining_capacity == 0) {
                    DB::rollBack();
                    return response()->json(['message' => 'Kapacita plná pre prednášku: ', 'talk' => $talk->title], 409);
                }
            }

            $verification_code = Str::random(6);
            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'role' => 'attendee',
                'verification_code' => bcrypt($verification_code)
            ]);

            foreach ($talks as $talk) {
                $talk->remaining_capacity -= 1;
                $talk->save();

                Registration::create([
                    'user_id' => $user->id,
                    'talk_id' => $talk->id,
                    'registered_at' => now(),
                    'attended' => false,
                ]);
            }
            try {
                Mail::to($email)->send(new RegistrationSuccessful($verification_code, $talks));
                Mail::to('samuelkascak@gmail.com')->send(new OrganizerNotification($user, $talks));
            } catch (\Exception $mailException) {
                DB::rollBack();
                return response()->json(['message' => 'Registration failed due to email sending issue', 'error' => $mailException->getMessage()], 500);
            }

            DB::commit();
            return response()->json(['message' => 'User registered successfully.', 'user' => $user], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }

    }

    public function unregister(Request $request) : JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|string',
        ]);

        $email = $request->input('email');
        $verification_code = $request->input('verification_code');

        DB::beginTransaction();

        try {
            $user = User::where('email', $email)->first();

            if (!$user || !Hash::check($verification_code, $user->verification_code)) {
                return response()->json(['message' => 'Invalid email or verification code.'], 400);
            }
            $user->delete();

            try {
                Mail::to($email)->send(new UnregisteredSuccessfully());
            } catch (\Exception $mailException) {
                DB::rollBack();
                return response()->json(['message' => 'Registration failed due to email sending issue', 'error' => $mailException->getMessage()], 500);
            }

            DB::commit();

            return response()->json(['message' => 'User unregistered successfully.'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Unregistration failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function getRegistrationsMetric()
    {
        $latestConference = Conference::orderBy('start_date', 'desc')->first();
        $previousYearDate = Carbon::parse($latestConference->start_date)->subYear();
        $previousYearConference = Conference::whereYear('start_date', $previousYearDate->year)
            ->orderBy('start_date', 'desc')
            ->first();

        $currentYearStart = Carbon::parse($latestConference->start_date)->startOfYear();
        $currentYearEnd = Carbon::parse($latestConference->start_date)->endOfYear();

        if ($previousYearConference) {
            $previousYearStart = Carbon::parse($previousYearConference->start_date)->startOfYear();
            $previousYearEnd = Carbon::parse($previousYearConference->start_date)->endOfYear();
        } else {
            $previousYearStart = null;
            $previousYearEnd = null;
        }

        $currentYearUniqueUsers = Registration::whereBetween('registered_at', [$currentYearStart, $currentYearEnd])
            ->distinct('user_id')
            ->count('user_id');
        $previousYearUniqueUsers = Registration::whereBetween('registered_at', [$previousYearStart, $previousYearEnd])
            ->distinct('user_id')
            ->count('user_id');

        if ($previousYearUniqueUsers > 0) {
            $percentageDifference = (($currentYearUniqueUsers - $previousYearUniqueUsers) / $previousYearUniqueUsers) * 100;
        } else {
            $percentageDifference = $currentYearUniqueUsers > 0 ? 100 : 0;
        }

        $results = [
            'current_year_unique_users' => $currentYearUniqueUsers,
            'percentage_difference' => round($percentageDifference),
        ];

        return $results;
    }
}
