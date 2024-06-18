<?php

namespace App\Http\Controllers;

use App\Mail\OrganizerNotification;
use App\Mail\RegistrationSuccessful;
use App\Mail\UnregisteredSuccessfully;
use App\Models\Registration;
use App\Models\Talk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class RegistrationController extends Controller
{
    private array $fillable_attributes = ["user_id", "talk_id", "registered_at", "attended"];

    public function register(Request $request) : JsonResponse
    {
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

    public function getRegistrations(): JsonResponse
    {
        $registrations = Registration::all();
        return response()->json($registrations);
    }

    public function getRegistrationById(int $id): JsonResponse
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['message' =>'Registration not found'], 404);
        }

        return response()->json($registration);
    }

    public function createRegistration(Request $request): JsonResponse
    {
        $registration = new Registration();

        foreach ($this->fillable_attributes as $attribute) {
            $registration->$attribute = $request->input($attribute);
        }
        $registration->save();

        return response()->json($registration);
    }

    public function updateRegistration(Request $request, int $id): JsonResponse
    {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }

        foreach ($this->fillable_attributes as $attribute) {
            if ($request->has($attribute)) {
                $registration->$attribute = $request->input($attribute);
            }
        }
        $registration->save();

        return response()->json($registration);
    }

    public function deleteRegistration($id): JsonResponse
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['message' => 'Registration not found'], 404);
        }
        $registration->delete();

        return response()->json(['message' => 'Registration deleted successfully']);
    }
}
