<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;


class RegistrationController extends Controller
{
    private array $fillable_attributes = ["user_id", "talk_id", "registered_at", "attended"];

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
