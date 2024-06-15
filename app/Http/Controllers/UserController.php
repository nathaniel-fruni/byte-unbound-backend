<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $fillableAttributes = ['first_name', 'last_name', 'email', 'password', 'role', 'verification_code'];

    public function getUsers($conference_id): JsonResponse
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

    public function createUser(Request $request): JsonResponse
    {
        $user = new User();
        foreach ($this->fillableAttributes as $attribute) {
            if ($attribute === 'password') {
                $user->$attribute = bcrypt($request->input($attribute));
            } else {
                $user->$attribute = $request->input($attribute);
            }
        }
        $user->save();

        return response()->json($user);
    }

    public function getUserById($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function updateUser(Request $request, $id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        foreach ($this->fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                if ($attribute === 'password') {
                    $user->$attribute = bcrypt($request->input($attribute));
                } else {
                    $user->$attribute = $request->input($attribute);
                }
            }
        }

        $user->save();

        return response()->json($user);
    }

    public function deleteUser($id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
